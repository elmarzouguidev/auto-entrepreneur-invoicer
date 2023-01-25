<?php

declare(strict_types=1);

namespace App\Http\Controllers\Commercial\Buy;

use App\Http\Controllers\Controller;
use App\Http\Requests\Commercial\BCommand\BCDeleteArticleFormRequest;
use App\Http\Requests\Commercial\BCommand\BCFormRequest;
use App\Http\Requests\Commercial\BCommand\BCUpdateFormRequest;
use App\Http\Requests\Commercial\BCommand\EmailFormRequest;
use App\Mail\Commercial\BC\SendBCMail;
use App\Models\Finance\Article;
use App\Models\Finance\BCommand;
use App\Repositories\Provider\ProviderInterface;
use App\Services\Commercial\Taxes\TVACalulator;
use App\Services\Mail\CheckConnection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class BuyBCommandController extends Controller
{
    use TVACalulator;

    public function indexFilter()
    {
        if (request()->has('appFilter') && request()->filled('appFilter')) {
            $commandes = QueryBuilder::for(BCommand::class)
                ->allowedFilters([
                    //'company_id'
                    //AllowedFilter::exact('etat')
                    AllowedFilter::scope('GetBCDate', 'filters_date_bc'),
                    AllowedFilter::scope('GetProvider', 'filters_providers'),
                    AllowedFilter::scope('DateBetween', 'filters_date'),

                ])
                ->with(['provider', 'provider.emails'])
                ->paginate(100)
                ->appends(request()->query());
        //->get();
        } else {
            $commandes = BCommand::with(['provider', 'provider.emails'])->get();
        }

        $providers = app(ProviderInterface::class)->Providers(['id', 'uuid', 'entreprise', 'contact']);

        return view('theme.pages.Commercial.BC.index', compact('commandes', 'providers'));
    }

    public function index()
    {
        $commandes = BCommand::with(['provider', 'provider.emails'])->get();

        return view('theme.pages.Commercial.BC.index', compact('commandes'));
    }

    public function create()
    {
        $this->authorize('create', BCommand::class);

        return view('theme.pages.Commercial.BC.__create.index');
    }

    public function store(BCFormRequest $request)
    {
        //dd($request->all());

        $this->authorize('create', BCommand::class);

        $articles = $request->articles;

        $totalPrice = collect($articles)->map(function ($item) {
            return $item['prix_unitaire'] * $item['quantity'];
        })->sum();

        $commandArticles = collect($articles)->map(function ($item) {
            return collect($item)->merge(['montant_ht' => $item['prix_unitaire'] * $item['quantity']]);
        })->toArray();

        $command = new BCommand();

        $command->date_command = $request->date('date_command');

        $command->condition_general = $request->condition_general;
        $command->admin_notes = $request->admin_notes;

        $command->price_ht = $totalPrice;

        $command->price_total = $this->caluculateTva($totalPrice);
        $command->price_tva = $this->calculateOnlyTva($totalPrice);

        $command->provider()->associate($request->provider);

        $command->save();

        $command->articles()->createMany($commandArticles);

        $command->histories()->create([
            'user_id' => auth()->id(),
            'user' => auth()->user()->full_name,
            'detail' => 'a crée le BC',
            'action' => 'add',
        ]);

        return redirect($command->edit_url)->with('success', 'Le BC a été crée avec success');
    }

    public function edit(BCommand $command)
    {
        $this->authorize('update', $command);

        $command->load('articles', 'provider', 'provider.emails', 'histories');

        return view('theme.pages.Commercial.BC.__edit.index', compact('command'));
    }

    public function update(BCUpdateFormRequest $request, BCommand $command)
    {
        $this->authorize('update', $command);

        $newArticles = $request->getArticles()->map(function ($item) {
            return collect($item)
                ->merge(['montant_ht' => $item['prix_unitaire'] * $item['quantity']]);
        })->toArray();

        $articlesData = array_filter(array_map('array_filter', $newArticles));

        $totalArticlePrice = collect($newArticles)->map(function ($item) {
            return $item['prix_unitaire'] * $item['quantity'];
        })->sum();

        $totalPrice = $command->price_ht + $totalArticlePrice;
        $command->price_ht = $totalPrice;
        $command->price_total = $this->caluculateTva($totalPrice);
        $command->price_tva = $this->calculateOnlyTva($totalPrice);

        $command->date_command = $request->date('date_command');

        $command->condition_general = $request->condition_general;
        $command->admin_notes = $request->admin_notes;

        $command->provider()->associate($request->provider);

        $command->save();

        if (! empty($articlesData)) {
            $command->articles()->createMany($articlesData);
        }

        $command->histories()->create([
            'user_id' => auth()->id(),
            'user' => auth()->user()->full_name,
            'detail' => 'a modifier le BC',
            'action' => 'update',
        ]);

        return redirect($command->edit_url)->with('success', 'Le BC a été modifier avec success');
    }

    public function deleteCommand(Request $request)
    {
        // dd($request->all());

        $request->validate(['commandId' => 'required|uuid']);

        $command = BCommand::whereUuid($request->commandId)->firstOrFail();

        $this->authorize('delete', $command);

        if ($command) {
            $command->articles()->delete();

            $command->histories()->create([
                'user_id' => auth()->id(),
                'user' => auth()->user()->full_name,
                'detail' => 'a supprimer le BC',
                'action' => 'delete',
            ]);

            $command->delete();

            return redirect(route('buy:bcommandes.index'))->with('success', 'La Commande  a éte supprimer avec success');
        }

        return redirect(route('buy:bcommandes.index'))->with('success', 'erreur . . . ');
    }

    public function deleteArticle(BCDeleteArticleFormRequest $request)
    {
        $command = BCommand::whereUuid($request->command)->firstOrFail();

        $article = Article::whereUuid($request->article)->firstOrFail();

        $this->authorize('delete', $command);

        if ($command && $article) {
            $totalPrice = $command->price_ht;

            $totalArticlePrice = $article->montant_ht;

            $finalPrice = $totalPrice - $totalArticlePrice;

            $article = $command->articles()
                ->whereUuid($request->article)
                ->whereId($article->id)
                ->whereArticleableId($command->id)
                ->forceDelete();

            if ($article) {
                $command->price_ht = $finalPrice;
                $command->price_total = $this->caluculateTva($finalPrice);
                $command->price_tva = $this->calculateOnlyTva($finalPrice);
                $command->save();
            }

            if ($command->articles()->count() <= 0) {
                $command->price_ht = 0;
                $command->price_total = 0;
                $command->price_tva = 0;
                $command->save();
            }
            $command->histories()->create([
                'user_id' => auth()->id(),
                'user' => auth()->user()->full_name,
                'detail' => 'a supprimer un article depuis le BC',
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

    public function sendBC(EmailFormRequest $request)
    {
        $bc = BCommand::whereUuid($request->bc)->first();

        //dd($request->input('emails.*.*'),$request->collect('emails.*.*'));
        $emails = $request->input('emails.*.*');

        if (CheckConnection::isConnected()) {
            if (isset($emails) && is_array($emails) && count($emails)) {
                foreach ($emails as $email) {
                    Mail::to($email)->send(new SendBCMail($bc));
                }
            }

            Mail::to($bc->provider)->send(new SendBCMail($bc));

            if (empty(Mail::failures())) {
                $bc->update(['is_send' => ! $bc->is_send]);

                $bc->histories()->create([
                    'user_id' => auth()->id(),
                    'user' => auth()->user()->full_name,
                    'detail' => 'A envoyer le BC par mail',
                    'action' => 'send',
                ]);

                return redirect()->back()->with('success', "l'email a été envoyé avec succès");
            }
        }

        return redirect()->back()->with('error', 'Email not send');
    }
}
