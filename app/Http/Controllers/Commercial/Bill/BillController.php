<?php

namespace App\Http\Controllers\Commercial\Bill;

use App\Http\Controllers\Controller;
use App\Http\Requests\Commercial\Bill\BillFormRequest;
use App\Http\Requests\Commercial\Bill\BillUpdateFormRequest;
use App\Models\Finance\Bill;
use App\Models\Finance\Invoice;
use App\Models\Utilities\PaymentType;
use Illuminate\Http\Request;

class BillController extends Controller
{
    public function index()
    {
        $bills = Bill::with('billable', 'payment')->get();

        $invoices = Invoice::select('id', 'uuid', 'code', 'price_total', 'full_number')
            ->doesntHave('bill')
            ->doesntHave('avoir')
            ->get();

        $payments = PaymentType::select(['id', 'name'])->get();

        return view('theme.pages.Commercial.Bill.__datatable.index', compact('bills', 'invoices', 'payments'));
    }

    public function create()
    {
        $this->authorize('create', Bill::class);

        return view('theme.pages.Commercial.Bill.__create_normal.index');
    }

    public function edit(Bill $bill)
    {
        //$bill->load('invoice');
        $this->authorize('update', $bill);
        $payments = PaymentType::select(['id', 'name'])->get();

        return view('theme.pages.Commercial.Bill.__edit.index', compact('bill', 'payments'));
    }

    public function update(BillUpdateFormRequest $request, Bill $bill)
    {
        $this->authorize('update', $bill);

        $bill->bill_date = $request->date('bill_date');
        $bill->payment()->associate($request->bill_mode);
        $bill->reference = $request->reference;
        $bill->notes = $request->notes;

        $bill->save();

        return redirect(route('commercial:bills.index'))->with('success', 'Le règlement  a éte modifier avec success');
    }

    public function addBill(Request $request)
    {
        $this->authorize('create', Bill::class);

        validator($request->route()->parameters(), [

            'invoice' => ['required', 'uuid'],

        ])->validate();

        $invoice = Invoice::whereUuid($request->invoice)->firstOrFail();

        return view('theme.pages.Commercial.Bill.__create.index', compact('invoice'));
    }

    public function storeBill(BillFormRequest $request, Invoice $invoice)
    {
        $this->authorize('create', Bill::class);

        $biller = [
            'bill_date' => $request->date('bill_date'),
            'bill_mode' => $request->bill_mode ?? $invoice->payment?->id,
            'reference' => $request->reference,
            'notes' => $request->notes,
            'price_ht' => $invoice->price_ht,
            'price_total' => $invoice->price_total,
            'price_tva' => $invoice->price_tva,
        ];

        $invoice->bill()->create($biller);

        $invoice->update(['status' => 'paid', 'is_paid' => true]);

        return redirect(route('commercial:bills.index'))->with('success', 'Le règlement  a éte ajouter avec success');
    }

    public function store(BillFormRequest $request)
    {
        $this->authorize('create', Bill::class);

        $invoice = Invoice::whereUuid($request->invoice)->firstOrFail();

        $biller = [
            'bill_date' => $request->date('bill_date'),
            'bill_mode' => $request->bill_mode,
            'reference' => $request->reference,
            'notes' => $request->notes,
            'price_ht' => $invoice->price_ht,
            'price_total' => $invoice->price_total,
            'price_tva' => $invoice->price_tva,
        ];

        $invoice->bill()->create($biller);

        $invoice->update(['status' => 'paid']);

        return redirect(route('commercial:bills.index'))->with('success', 'Le règlement  a éte ajouter avec success');
    }

    public function deleteBill(Request $request)
    {
        $request->validate(['billId' => 'required|uuid']);

        $bill = Bill::whereUuid($request->billId)->firstOrFail();

        $this->authorize('delete', $bill);

        $invoice = $bill->billable()->first();

        if ($bill) {
            if ($invoice) {
                $invoice->update(['status' => 'non-paid']);
            }

            $bill->delete();

            return redirect()->back()->with('success', 'Le règlement  a éte supprimer avec success');
        }

        return redirect()->back()->with('success', 'erreur . . . ');
    }
}
