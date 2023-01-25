<?php

declare(strict_types=1);

namespace App\Http\Controllers\Expense\Expense;

use App\Http\Controllers\Controller;
use App\Http\Requests\Expense\ExpenseInvoiceFormRequest;
use App\Http\Requests\Expense\ExpenseInvoiceUpdateFormRequest;
use App\Models\Expense\ExpenseCategory;
use App\Models\Expense\ExpenseInvoice;
use App\Models\Schedule\Schedule;
use App\Models\Utilities\Currency;
use App\Models\Utilities\Tax;
use App\Repositories\Provider\ProviderInterface;
use App\Services\Commercial\Taxes\TVACalulator;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    use TVACalulator;

    public function index()
    {
        $expenses = ExpenseInvoice::with(['taxe', 'provider', 'category', 'currency', 'expense'])->get();

        $taxes = Tax::select(['id', 'taux_percent', 'name'])->get();

        $providers = app(ProviderInterface::class)->Providers();

        $categories = ExpenseCategory::all();

        $currencies = Currency::all();

        $schedules = Schedule::all();

        return view('theme.pages.Expense.Expense.index', compact('expenses', 'taxes', 'providers', 'categories', 'currencies', 'schedules'));
    }

    public function create()
    {
        $taxes = Tax::select(['id', 'taux_percent', 'name'])->get();

        $providers = app(ProviderInterface::class)->Providers();

        return view('theme.pages.Expense.Expense.create.index', compact('providers', 'taxes'));
    }

    public function store(ExpenseInvoiceFormRequest $request)
    {
        $invoice = new ExpenseInvoice();
        $invoice->price_ht = $request->price_ht;
        $invoice->invoice_date = $request->date('invoice_date');
        $invoice->note = $request->note;
        $invoice->reference = $request->reference;

        $invoice->category()->associate($request->category);
        $invoice->currency()->associate($request->currency);

        $invoice->provider()->associate($request->provider);

        $request->whenFilled('taxe', function ($taxe) use ($invoice) {
            $invoice->taxe()->associate($taxe)->save();

            $totalPrice = $this->caluculateTotalWithTax($invoice->price_ht, $invoice->taxe?->taux_percent);

            $taxePrice = $this->calculateOnlyTax($invoice->price_ht, $invoice->taxe?->taux_percent);

            $invoice->price_total = $totalPrice;

            $invoice->price_tax = $taxePrice;
        });

        if ($request->hasFile('expense_file')) {
            $invoice->addMediaFromRequest('expense_file')->toMediaCollection('expenses');
        }

        $invoice->save();

        return redirect()->back()->with('success', 'La Dépense a été crée avec success');
    }

    public function edit(ExpenseInvoice $invoice)
    {
        $taxes = Tax::select(['id', 'taux_percent', 'name'])->get();

        $providers = app(ProviderInterface::class)->Providers();

        $categories = ExpenseCategory::all();

        $currencies = Currency::all();

        return view('theme.pages.Expense.Expense.edit.index', compact('invoice', 'taxes', 'providers', 'currencies', 'categories'));
    }

    public function update(ExpenseInvoiceUpdateFormRequest $request, ExpenseInvoice $invoice)
    {
        $invoice->price_ht = $request->price_ht;
        $invoice->invoice_date = $request->date('invoice_date');
        $invoice->note = $request->note;
        $invoice->reference = $request->reference;

        $invoice->category()->associate($request->category);

        $invoice->currency()->associate($request->currency);

        $invoice->provider()->associate($request->provider);

        $request->whenFilled('taxe', function ($taxe) use ($invoice) {
            $invoice->taxe()->associate($taxe)->save();

            $totalPrice = $this->caluculateTotalWithTax($invoice->price_ht, $invoice->taxe?->taux_percent);

            $taxePrice = $this->calculateOnlyTax($invoice->price_ht, $invoice->taxe?->taux_percent);

            $invoice->price_total = $totalPrice;

            $invoice->price_tax = $taxePrice;
        });

        if ($request->hasFile('expense_file')) {
            $invoice->clearMediaCollection('expense_file');

            $invoice->addMediaFromRequest('expense_file')->toMediaCollection('expenses');
        }

        $invoice->save();

        return redirect()->route('expense:invoices.index')->with('success', 'La Dépense a été modifier avec success');
    }

    public function delete(Request $request)
    {
        $request->validate(['invoiceId' => 'required|uuid']);

        $invoice = ExpenseInvoice::whereUuid($request->invoiceId)->firstOrFail();

        // $this->authorize('delete', $invoice);

        if ($invoice) {
            $invoice->delete();

            return redirect(route('expense:invoices.index'))->with('success', 'La Dépense  a éte supprimer avec success');
        }

        return redirect(route('expense:invoices.index'))->with('error', 'erreur . . . ');
    }
}
