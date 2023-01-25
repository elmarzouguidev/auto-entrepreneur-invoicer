<?php

declare(strict_types=1);

namespace App\Http\Controllers\Commercial\Buy;

use App\Http\Controllers\Controller;
use App\Http\Requests\Commercial\Buy\BuyInvoiceFormRequest;
use App\Http\Requests\Commercial\Buy\BuyInvoiceUpdateFormRequest;
use App\Models\Finance\Buy\BuyInvoice;
use App\Models\Utilities\Tax;
use App\Repositories\Provider\ProviderInterface;
use App\Services\Commercial\Taxes\TVACalulator;
use Illuminate\Http\Request;

class BuyInvoiceController extends Controller
{
    use TVACalulator;

    public function index()
    {
        $invoices = BuyInvoice::with('provider')->get();

        $taxes = Tax::select(['id', 'taux_percent', 'name'])->get();

        $providers = app(ProviderInterface::class)->Providers();

        return view('theme.pages.Commercial.Buy.BuyInvoice.index', compact('invoices', 'taxes', 'providers'));
    }

    public function create()
    {
        $providers = app(ProviderInterface::class)->Providers();
        $taxes = Tax::select(['id', 'taux_percent', 'name'])->get();

        return view('theme.pages.Commercial.Buy.BuyInvoice.create.index', compact('providers', 'taxes'));
    }

    public function store(BuyInvoiceFormRequest $request)
    {
        $invoice = new BuyInvoice();
        $invoice->price_ht = $request->price_ht;
        $invoice->code = $request->code;
        $invoice->condition_general = $request->notes;
        $invoice->invoice_date = $request->date('invoice_date');

        if ($request->hasFile('invoice_file')) {
            $invoice->addMediaFromRequest('invoice_file')->toMediaCollection('buy_invoices');
        }

        $request->whenFilled('taxe', function ($taxe) use ($invoice) {
            $invoice->taxe()->associate($taxe)->save();

            $totalPrice = $this->caluculateTotalWithTax($invoice->price_ht, $invoice->taxe?->taux_percent);

            $taxePrice = $this->calculateOnlyTax($invoice->price_ht, $invoice->taxe?->taux_percent);

            $invoice->price_total = $totalPrice;

            $invoice->price_tva = $taxePrice;
        });

        $request->whenFilled('provider', function ($provider) use ($invoice) {
            $invoice->provider()->associate($provider)->save();
        });

        $invoice->save();

        return redirect(route('buy:invoices.index'))->with('success', 'la facture a été crée avec succès');
    }

    public function edit(BuyInvoice $invoice)
    {
        $providers = app(ProviderInterface::class)->Providers();

        $taxes = Tax::select(['id', 'taux_percent', 'name'])->get();

        return view('theme.pages.Commercial.Buy.BuyInvoice.edit.index', compact('invoice', 'taxes', 'providers'));
    }

    public function update(BuyInvoiceUpdateFormRequest $request, BuyInvoice $invoice)
    {
        $invoice->price_ht = $request->price_ht;
        $invoice->code = $request->code;
        $invoice->condition_general = $request->notes;
        $invoice->invoice_date = $request->date('invoice_date');

        if ($request->hasFile('invoice_file')) {
            $invoice->clearMediaCollection('buy_invoices');

            $invoice->addMediaFromRequest('invoice_file')->toMediaCollection('buy_invoices');
        }

        $request->whenFilled('taxe', function ($taxe) use ($invoice) {
            $invoice->taxe()->associate($taxe)->save();

            $totalPrice = $this->caluculateTotalWithTax($invoice->price_ht, $invoice->taxe?->taux_percent);

            $taxePrice = $this->calculateOnlyTax($invoice->price_ht, $invoice->taxe?->taux_percent);

            $invoice->price_total = $totalPrice;

            $invoice->price_tva = $taxePrice;
        });

        $request->whenFilled('provider', function ($provider) use ($invoice) {
            $invoice->provider()->associate($provider)->save();
        });

        $invoice->save();

        return redirect(route('buy:invoices.index'))->with('success', 'la facture a été modifier avec succès');
    }

    public function delete(Request $request)
    {
        $request->validate(['invoiceId' => 'required|uuid']);

        $invoice = BuyInvoice::whereUuid($request->invoiceId)->firstOrFail();

        $this->authorize('delete', $invoice);

        if ($invoice) {
            $invoice->delete();

            return redirect(route('buy:invoices.index'))->with('success', 'La facture  a éte supprimer avec succès');
        }

        return redirect(route('buy:invoices.index'))->with('error', 'vous nous pouvez pas supprimer cette facture ');
    }
}
