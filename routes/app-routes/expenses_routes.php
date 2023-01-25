<?php

use App\Http\Controllers\Expense\Automation\AutomationController;
use App\Http\Controllers\Expense\Expense\ExpenseController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'expenses', 'middleware' => 'role_or_permission:SuperAdmin|expenses.browse'], function () {
    Route::group(['prefix' => 'automations'], function () {
        Route::get('/', [AutomationController::class, 'index'])->name('automations.index');

        Route::post('/', [AutomationController::class, 'store'])->name('automations.store');

        Route::delete('/', [AutomationController::class, 'delete'])->name('automations.delete');

        Route::get('/create', [AutomationController::class, 'create'])->name('automations.create');
        Route::post('/create', [AutomationController::class, 'create'])->name('automations.store.new');

        Route::get('/edit/{expense}', [AutomationController::class, 'edit'])->name('automations.edit');
        Route::post('/edit/{expense}', [AutomationController::class, 'update'])->name('automations.update');
    });

    Route::group(['prefix' => 'invoices'], function () {
        Route::get('/', [ExpenseController::class, 'index'])->name('invoices.index');
        Route::post('/', [ExpenseController::class, 'store'])->name('invoices.store');
        Route::delete('/', [ExpenseController::class, 'delete'])->name('invoices.delete');

        Route::get('/edit/{invoice}', [ExpenseController::class, 'edit'])->name('invoices.edit');
        Route::post('/edit/{invoice}', [ExpenseController::class, 'update'])->name('invoices.update');

        Route::post('/views/{invoice}', [ExpenseController::class, 'view'])->name('invoices.view');
    });
});
