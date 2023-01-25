<?php

declare(strict_types=1);

namespace App\Http\Controllers\Expense\Automation;

use App\Http\Controllers\Controller;
use App\Http\Requests\Expense\AutomationFormRequest;
use App\Models\Expense\Expense;
use App\Models\Expense\ExpenseCategory;
use App\Models\Schedule\Schedule;
use App\Models\Utilities\Currency;
use App\Models\Utilities\Tax;
use App\Repositories\Provider\ProviderInterface;
use App\Services\Commercial\Taxes\TVACalulator;
use Illuminate\Http\Request;

class AutomationController extends Controller
{
    use TVACalulator;

    public function index()
    {
        $expenses = Expense::with(['taxe', 'provider', 'category', 'currency'])->get();

        $taxes = Tax::select(['id', 'taux_percent', 'name'])->get();

        $providers = app(ProviderInterface::class)->Providers();

        $categories = ExpenseCategory::all();

        $currencies = Currency::all();

        $schedules = Schedule::all();

        return view('theme.pages.Expense.Automation.index', compact('expenses', 'taxes', 'providers', 'categories', 'currencies', 'schedules'));
    }

    public function create()
    {
        $taxes = Tax::select(['id', 'taux_percent', 'name'])->get();

        $providers = app(ProviderInterface::class)->Providers();

        return view('theme.pages.Expense.Automation.create.index', compact('providers', 'taxes'));
    }

    public function store(AutomationFormRequest $request)
    {
        $expense = new Expense();
        $expense->name = $request->name;
        $expense->price_ht = $request->price_ht;
        $expense->expense_date = $request->date('expense_date');
        $expense->reference = $request->reference;
        $expense->note = $request->note;

        $expense->category()->associate($request->category);
        $expense->currency()->associate($request->currency);

        $expense->provider()->associate($request->provider);
        $expense->schedule()->associate($request->schedule);

        $request->whenFilled('taxe', function ($taxe) use ($expense) {
            $expense->taxe()->associate($taxe)->save();

            $totalPrice = $this->caluculateTotalWithTax($expense->price_ht, $expense->taxe?->taux_percent);

            $taxePrice = $this->calculateOnlyTax($expense->price_ht, $expense->taxe?->taux_percent);

            $expense->price_total = $totalPrice;

            $expense->price_tax = $taxePrice;
        });

        $expense->save();

        return redirect()->back()->with('success', "L'automatisation a été crée avec success");
    }

    public function delete(Request $request)
    {
        $request->validate(['expenseId' => 'required|uuid']);

        $expense = Expense::whereUuid($request->expenseId)->firstOrFail();

        $this->authorize('delete', $expense);

        if ($expense && ! $expense->invoices()->exists()) {
            $expense->delete();

            return redirect(route('expense:index'))->with('success', "L'automatisation  a éte supprimer avec success");
        }

        return redirect(route('expense:index'))->with('error', 'erreur . . . ');
    }
}
