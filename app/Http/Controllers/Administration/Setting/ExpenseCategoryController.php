<?php

declare(strict_types=1);

namespace App\Http\Controllers\Administration\Setting;

use App\Http\Controllers\Controller;
use App\Http\Requests\Setting\Expense\ExpenseCategoryFormRequest;
use App\Models\Expense\ExpenseCategory;
use Illuminate\Http\Request;

class ExpenseCategoryController extends Controller
{
    public function index()
    {
        $categories = ExpenseCategory::all();

        return view('theme.pages.SettingV2.Expense.index', [
            'categories' => $categories,
        ]);
    }

    public function store(ExpenseCategoryFormRequest $request)
    {
        $expense = new ExpenseCategory();
        $expense->name = $request->name;
        $expense->save();

        return redirect(route('admin:settings.expense'))->with('success', 'La catégorie a éte crée avec succès');
    }

    public function delete(Request $request)
    {
        $expense = ExpenseCategory::whereUuid($request->categoryId)->first();

        if ($expense) {
            $expense->delete();

            return redirect(route('admin:settings.expense'))->with('success', 'La catégorie a éte supprimer avec succès');
        }

        return redirect(route('admin:settings.expense'))->with('error', 'vous nous pouvez pas supprimer cette catégorie');
    }
}
