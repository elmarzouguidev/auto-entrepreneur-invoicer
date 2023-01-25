<?php

namespace App\Http\Controllers\Commercial\Invoice;

use App\Http\Controllers\Controller;
use App\Http\Requests\Commercial\Invoice\DeleteArticleFormRequest;
use App\Http\Requests\Commercial\Invoice\InvoiceFormRequest;
use App\Http\Requests\Commercial\Invoice\InvoiceUpdateFormRequest;
use App\Models\Finance\Article;
use App\Models\Finance\Estimate;
use App\Models\Finance\Invoice;
use App\Models\Utilities\PaymentType;
use App\Repositories\Client\ClientInterface;
use App\Services\Commercial\Remise\RemiseCalculator;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class InvoiceController extends Controller
{
    use RemiseCalculator;

    public function indexFilter()
    {
        if (request()->has('appFilter') && request()->filled('appFilter')) {
            $invoices = QueryBuilder::for(Invoice::class)
                ->allowedFilters([
                    AllowedFilter::scope('GetInvoiceDate', 'filters_date_invoice'),
                    AllowedFilter::scope('GetStatus', 'filters_status'),
                    AllowedFilter::scope('GetClient', 'filters_clients'),
                    AllowedFilter::scope('DateBetween', 'filters_date'),

                ])
                ->with(['client', 'bill'])
                ->withCount('bill')
                ->paginate(200)
                ->appends(request()->query());
            //->get();
        } else {
            $invoices = Invoice::with(['client', 'bill'])->withCount('bill')
                ->get();
        }

        $clients = app(ClientInterface::class)->getClients(['id', 'uuid', 'entreprise', 'contact']);

        $payments = PaymentType::select(['id', 'name'])->get();

        return view('theme.pages.Commercial.Invoice.index', compact('invoices', 'clients', 'payments'));
    }

    public function index()
    {
        $invoices = Invoice::with(['company', 'client'])->paginate(5);

        return view('theme.pages.Commercial.Invoice.index', compact('invoices'));
    }

    public function create()
    {
        $this->authorize('create', Invoice::class);

        $payments = PaymentType::select(['id', 'name'])->get();

        return view('theme.pages.Commercial.Invoice.__create.index', compact('payments'));
    }

    public function single(Invoice $invoice)
    {
        $invoice->load('articles');

        return view('theme.pages.Commercial.Invoice.__detail.index', compact('invoice'));
    }

    public function store(InvoiceFormRequest $request)
    {
        $this->authorize('create', Invoice::class);

        $invoice = new Invoice();

        $invoice->bl_code = $request->bl_code;
        $invoice->bc_code = $request->bc_code;

        $invoice->invoice_date = $request->date('invoice_date');
        $invoice->due_date = $request->date('due_date');

        $invoice->payment()->associate($request->payment_mode);

        $invoice->admin_notes = $request->admin_notes;

        $invoice->condition_general = $request->condition_general;

        $invoice->price_total = $this->hasItems($request)['totalPrice'];

        $invoice->client_id = $request->client;

        $invoice->status = 'non-paid';

        $invoice->save();

        if ($request->has('estimated') && $request->filled('estimated')) {
            $estimate = Estimate::whereUuid($request->estimated)->firstOrFail();

            $estimate->invoice()->associate($invoice)->save();

            $estimate->update(['is_invoiced' => true]);
        }

        $invoice->articles()->createMany($this->hasItems($request)['articles']);

        $invoice->histories()->create([
            'user_id' => auth()->id(),
            'user' => auth()->user()->full_name,
            'detail' => 'a crée la facture',
            'action' => 'add',
        ]);

        return redirect($invoice->edit_url)->with('success', 'La Facture  a éte crée avec success');
    }

    private function hasItems(Request $request)
    {

        $articles = $request->articles;

        $totalPriceRemise = collect($articles)->map(function ($item) {
            if ($item['remise'] && $item['remise'] > 0 && $item['remise'] !== 0) {
                $itemPrice = $item['prix_unitaire'] * $item['quantity'];
                $finalePrice = $this->caluculateRemise($itemPrice, $item['remise']);

                return $finalePrice;
            }

            return $item['prix_unitaire'] * $item['quantity'];
        })->sum();

        $invoicesArticles = collect($articles)->map(function ($item) {
            if ($item['remise'] && $item['remise'] > 0 && $item['remise'] !== 0) {
                //dd('ohoer');
                $itemPrice = $item['prix_unitaire'] * $item['quantity'];
                $finalePrice = $this->caluculateRemise($itemPrice, $item['remise']);
                $tauxRemise = $this->calculateOnlyRemise($itemPrice, $item['remise']);

                return collect($item)->merge(['montant_ht' => $finalePrice, 'taux_remise' => $tauxRemise]);
            }

            return collect($item)->merge(['remise' => '0', 'montant_ht' => $item['prix_unitaire'] * $item['quantity']]);
        })->toArray();

        return ['articles' => $invoicesArticles, 'totalPrice' => $totalPriceRemise];
    }

    public function edit(Invoice $invoice)
    {
        $this->authorize('update', $invoice);

        $invoice->load('articles', 'histories')->loadCount('bill');

        $payments = PaymentType::select(['id', 'name'])->get();

        return view('theme.pages.Commercial.Invoice.__edit.index', compact('invoice', 'payments'));
    }

    public function update(InvoiceUpdateFormRequest $request, Invoice $invoice)
    {
        $this->authorize('update', $invoice);

        $newArticles = $request->getNewArticles()->map(function ($item) {
            if ($item['remise'] && $item['remise'] > 0 && $item['remise'] !== 0) {
                $itemPrice = $item['prix_unitaire'] * $item['quantity'];
                $finalePrice = $this->caluculateRemise($itemPrice, $item['remise']);
                $tauxRemise = $this->calculateOnlyRemise($itemPrice, $item['remise']);

                return collect($item)->merge(['montant_ht' => $finalePrice, 'taux_remise' => $tauxRemise]);
            }

            return collect($item)->merge(['remise' => '0', 'montant_ht' => $item['prix_unitaire'] * $item['quantity']]);
        })->toArray();

        $articlesData = array_filter(array_map('array_filter', $newArticles));

        $totalPriceRemise = collect($newArticles)->map(function ($item) {
            if ($item['remise'] && $item['remise'] > 0 && $item['remise'] !== 0) {
                $itemPrice = $item['prix_unitaire'] * $item['quantity'];
                $finalePrice = $this->caluculateRemise($itemPrice, $item['remise']);

                return $finalePrice;
            }

            return $item['prix_unitaire'] * $item['quantity'];
        })->sum();

        $totalPrice = $invoice->price_ht + $totalPriceRemise;

        $invoice->price_total = $totalPrice;

        $invoice->bl_code = $request->bl_code;
        $invoice->bc_code = $request->bc_code;

        $invoice->invoice_date = $request->date('invoice_date');
        $invoice->due_date = $request->date('due_date');

        $invoice->payment()->associate($request->payment_mode);

        $invoice->admin_notes = $request->admin_notes;
        $invoice->condition_general = $request->condition_general;

        $invoice->save();

        if (!empty($articlesData)) {
            $invoice->articles()->createMany($articlesData);
        }

        $invoice->histories()->create([
            'user_id' => auth()->id(),
            'user' => auth()->user()->full_name,
            'detail' => 'a modifier la facture',
            'action' => 'update',
        ]);

        return redirect($invoice->edit_url)->with('success', 'Le Facture a été modifier avec success');
    }

    public function deleteInvoice(Request $request)
    {
        $request->validate(['invoiceId' => 'required|uuid']);

        $invoice = Invoice::whereUuid($request->invoiceId)->firstOrFail();

        $this->authorize('delete', $invoice);

        if ($invoice) {
            $invoice->articles()
                ->where('articleable_type', 'App\Models\Finance\Invoice')
                ->where('articleable_id', $invoice->id)
                ->delete();

            $invoice->estimate()->update(['is_invoiced' => false]);

            $invoice->histories()->delete();

            $invoice->delete();

            return redirect(route('commercial:invoices.index'))->with('success', 'La Facture  a éte supprimer avec success');
        }

        return redirect(route('commercial:invoices.index'))->with('error', 'erreur . . . ');
    }

    public function deleteArticle(DeleteArticleFormRequest $request)
    {
        $invoice = Invoice::whereUuid($request->invoice)->firstOrFail();
        $article = Article::whereUuid($request->article)->firstOrFail();

        $this->authorize('delete', $invoice);

        if ($invoice && $article) {
            $totalPrice = $invoice->price_total;

            $totalArticlePrice = $article->montant_ht;

            $finalPrice = $totalPrice - $totalArticlePrice;

            $article = $invoice->articles()
                ->whereUuid($request->article)
                ->whereId($article->id)
                ->whereArticleableId($invoice->id)
                ->forceDelete();

            if ($article) {
                $invoice->price_total = $finalPrice;
                $invoice->save();
            }

            if ($invoice->articles()->count() <= 0) {
                $invoice->price_total = 0;
                $invoice->save();
            }

            $invoice->histories()->create([
                'user_id' => auth()->id(),
                'user' => auth()->user()->full_name,
                'detail' => 'a supprimer un article depuis  la facture',
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
}
