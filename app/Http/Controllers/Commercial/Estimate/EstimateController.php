<?php

namespace App\Http\Controllers\Commercial\Estimate;

use App\Http\Controllers\Controller;
use App\Http\Requests\Commercial\Estimate\EstimateDeleteRequest;
use App\Http\Requests\Commercial\Estimate\EstimateFormRequest;
use App\Http\Requests\Commercial\Estimate\EstimateUpdateFormRequest;
use App\Http\Requests\Commercial\Estimate\SendEmailFormRequest;
use App\Mail\Commercial\Estimate\DeleteItemMail;
use App\Mail\Commercial\Estimate\SendEstimateMail;
use App\Models\Finance\Article;
use App\Models\Finance\Estimate;
use App\Models\Utilities\PaymentType;
use App\Repositories\Client\ClientInterface;
use App\Services\Commercial\Remise\RemiseCalculator;
use App\Services\Commercial\Taxes\TVACalulator;
use App\Services\Mail\CheckConnection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class EstimateController extends Controller
{
    use TVACalulator;
    use RemiseCalculator;

    public function indexFilter()
    {
        if (request()->has('appFilter') && request()->filled('appFilter')) {
            $estimates = QueryBuilder::for(Estimate::class)
                ->allowedFilters([
                    AllowedFilter::scope('GetEstimateDate', 'filters_date_estimate'),
                    AllowedFilter::scope('GetStatus', 'filters_status'),
                    AllowedFilter::scope('GetClient', 'filters_clients'),
                    AllowedFilter::scope('GetSend', 'filters_send'),
                    AllowedFilter::scope('DateBetween', 'filters_date'),
                ])
                ->with(['client:id,entreprise,email', 'client.emails'])
                ->withCount('invoice')
                ->paginate(200)
                ->appends(request()->query());
        //->get();
        } else {
            $estimates = Estimate::with(['client:id,entreprise,email', 'client.emails'])
                ->withCount('invoice')
                //->paginate(20);
                ->get();
        }

        $clients = app(ClientInterface::class)->getClients(['id', 'uuid', 'entreprise', 'contact']);

        return view('theme.pages.Commercial.Estimate.index', compact('estimates', 'clients'));
    }

    public function index()
    {
        $estimates = Estimate::with(['client:id,entreprise,email', 'client.emails'])
            ->withCount('invoice')
            //->paginate(20);
            ->get();

        return view('theme.pages.Commercial.Estimate.index', compact('estimates'));
    }

    public function create()
    {
        $this->authorize('create', Estimate::class);

        $payments = PaymentType::select(['id', 'name'])->get();

        return view('theme.pages.Commercial.Estimate.__create.index', compact('payments'));
    }

    public function store(EstimateFormRequest $request)
    {
        $this->authorize('create', Estimate::class);

        $articles = $request->articles;

        $totalPrice = collect($articles)->map(function ($item) {
            return $item['prix_unitaire'] * $item['quantity'];
        })->sum();

        $totalPriceRemise = collect($articles)->map(function ($item) {
            if ($item['remise'] && $item['remise'] > 0 && $item['remise'] !== 0) {
                $itemPrice = $item['prix_unitaire'] * $item['quantity'];
                $finalePrice = $this->caluculateRemise($itemPrice, $item['remise']);

                return $finalePrice;
            }

            return $item['prix_unitaire'] * $item['quantity'];
        })->sum();

        $estimateArticles = collect($articles)->map(function ($item) {
            if ($item['remise'] && $item['remise'] > 0 && $item['remise'] !== 0) {
                //dd('ohoer');
                $itemPrice = $item['prix_unitaire'] * $item['quantity'];
                $finalePrice = $this->caluculateRemise($itemPrice, $item['remise']);
                $tauxRemise = $this->calculateOnlyRemise($itemPrice, $item['remise']);

                return collect($item)->merge(['montant_ht' => $finalePrice, 'taux_remise' => $tauxRemise]);
            }

            return collect($item)->merge(['remise' => '0', 'montant_ht' => $item['prix_unitaire'] * $item['quantity']]);
        })->toArray();

        $estimate = new Estimate();

        $estimate->estimate_date = $request->date('estimate_date');
        $estimate->due_date = $request->date('due_date');

        $estimate->payment()->associate($request->payment_mode);

        $estimate->admin_notes = $request->admin_notes;

        $estimate->condition_general = $request->condition_general;

        $estimate->price_ht = $totalPriceRemise;

        //$estimate->ht_price_remise = $totalPrice;

        $estimate->price_total = $this->caluculateTva($totalPriceRemise);
        $estimate->price_tva = $this->calculateOnlyTva($totalPriceRemise);

        $estimate->client_id = $request->client;

        $estimate->save();

        $estimate->articles()->createMany($estimateArticles);

        $estimate->histories()->create([
            'user_id' => auth()->id(),
            'user' => auth()->user()->full_name,
            'detail' => 'a crée le DEVIS ',
            'action' => 'add',
        ]);

        return redirect($estimate->edit_url)->with('success', 'Le Devis a éte crée avec success');
    }

    public function single(Estimate $estimate)
    {
        $estimate->load('articles');

        return view('theme.pages.Commercial.Estimate.__detail.index', compact('estimate'));
    }

    public function edit(Estimate $estimate)
    {
        $this->authorize('update', $estimate);

        $estimate->load('articles', 'histories')->loadCount('invoice');

        $payments = PaymentType::select(['id', 'name'])->get();

        return view('theme.pages.Commercial.Estimate.__edit.index', compact('estimate', 'payments'));
    }

    public function update(EstimateUpdateFormRequest $request, Estimate $estimate)
    {
        $this->authorize('update', $estimate);

        $newArticles = $request->newArticles()->map(function ($item) {
            if ($item['remise'] && $item['remise'] > 0 && $item['remise'] !== 0) {
                $itemPrice = $item['prix_unitaire'] * $item['quantity'];
                $finalePrice = $this->caluculateRemise($itemPrice, $item['remise']);
                $tauxRemise = $this->calculateOnlyRemise($itemPrice, $item['remise']);

                return collect($item)->merge(['montant_ht' => $finalePrice, 'taux_remise' => $tauxRemise]);
            }

            return collect($item)->merge(['remise' => '0', 'montant_ht' => $item['prix_unitaire'] * $item['quantity']]);
        })->toArray();

        $articlesData = array_filter(array_map('array_filter', $newArticles));

        $totalArticlePrice = collect($newArticles)->map(function ($item) {
            return $item['prix_unitaire'] * $item['quantity'];
        })->sum();

        $totalPriceRemise = collect($newArticles)->map(function ($item) {
            if ($item['remise'] && $item['remise'] > 0 && $item['remise'] !== 0) {
                $itemPrice = $item['prix_unitaire'] * $item['quantity'];
                $finalePrice = $this->caluculateRemise($itemPrice, $item['remise']);

                return $finalePrice;
            }

            return $item['prix_unitaire'] * $item['quantity'];
        })->sum();

        $totalPrice = $estimate->price_ht + $totalPriceRemise;
        $estimate->price_ht = $totalPrice;
        $estimate->price_total = $this->caluculateTva($totalPrice);
        $estimate->price_tva = $this->calculateOnlyTva($totalPrice);
        //$estimate->ht_price_remise = $totalArticlePrice;

        $estimate->estimate_date = $request->date('estimate_date');
        $estimate->due_date = $request->date('due_date');

        $estimate->payment()->associate($request->payment_mode);

        $estimate->admin_notes = $request->admin_notes;

        $estimate->condition_general = $request->condition_general;

        $estimate->save();

        if (! empty($articlesData)) {
            $estimate->articles()->createMany($articlesData);
        }

        $estimate->histories()->create([
            'user_id' => auth()->id(),
            'user' => auth()->user()->full_name,
            'detail' => 'a modifier le DEVIS ',
            'action' => 'update',
        ]);

        return redirect($estimate->edit_url)->with('success', 'Le devis a été modifier avec success');
    }

    public function deleteEstimate(Request $request)
    {
        $request->validate(['estimateId' => 'required|uuid']);

        $estimate = Estimate::whereUuid($request->estimateId)->firstOrFail();

        $this->authorize('delete', $estimate);

        if ($estimate) {
            $estimate->articles()->delete();

            $estimate->histories()->delete();

            //if (CheckConnection::isConnected()) {

            // Mail::to($estimate->company->email)->send(New DeleteItemMail($estimate));

            // if (empty(Mail::failures())) {

            $estimate->delete();

            return redirect(route('commercial:estimates.index'))->with('success', 'Le devis  a éte supprimer avec success');
            //}
            //}
        }

        return redirect(route('commercial:estimates.index'))->with('success', 'erreur . . . ');
    }

    public function deleteArticle(EstimateDeleteRequest $request)
    {
        $estimate = Estimate::whereUuid($request->estimate)->firstOrFail();

        $article = Article::whereUuid($request->article)->firstOrFail();

        if ($estimate && $article) {
            $totalPrice = $estimate->price_ht;

            $totalArticlePrice = $article->montant_ht;

            $finalPrice = $totalPrice - $totalArticlePrice;

            $estimate->articles()
                ->whereUuid($request->article)
                ->whereId($article->id)
                ->whereArticleableId($estimate->id)
                ->forceDelete();

            if ($article) {
                $estimate->price_ht = $finalPrice;
                $estimate->price_total = $this->caluculateTva($finalPrice);
                $estimate->price_tva = $this->calculateOnlyTva($finalPrice);
                $estimate->save();
            }
            if ($estimate->articles()->count() <= 0) {
                $estimate->price_ht = 0;
                $estimate->price_total = 0;
                $estimate->price_tva = 0;
                $estimate->save();
            }
            $estimate->histories()->create([
                'user_id' => auth()->id(),
                'user' => auth()->user()->full_name,
                'detail' => 'a supprimer un article depuis le DEVIS ',
                'action' => 'delete',
            ]);

            return response()->json([
                'success' => 'Record deleted successfully!',
            ]);
        }

        return response()->json([
            'error' => 'problem detected !',
        ]);
    }

    public function createInvoice(Estimate $estimate)
    {
        $estimate->load('articles', 'client:id,entreprise');

        $payments = PaymentType::select(['id', 'name'])->get();

        return view('theme.pages.Commercial.Invoice.__create_from_estimate.index', compact('estimate', 'payments'));
    }

    public function sendEstimate(SendEmailFormRequest $request)
    {
        $estimate = Estimate::whereUuid($request->estimater)->first();

        $emails = $request->input('emails.*.*');

        if (CheckConnection::isConnected()) {
            if (isset($emails) && is_array($emails) && count($emails)) {
                foreach ($emails as $email) {
                    Mail::to($email)->send(new SendEstimateMail($estimate));
                }
            }

            Mail::to($estimate->client?->email)->send(new SendEstimateMail($estimate));

            if (empty(Mail::failures())) {
                $estimate->update(['is_send' => ! $estimate->is_send]);

                $estimate->histories()->create([
                    'user_id' => auth()->id(),
                    'user' => auth()->user()->full_name,
                    'detail' => 'A envoyer le devis par mail',
                    'action' => 'send',
                ]);

                return redirect()->back()->with('success', "l'email a été envoyé avec succès");
            }
        }

        return redirect()->back()->with('error', 'Email not send');
    }
}
