<?php

use App\Http\Controllers\Administration\Admin\AdminController;
use App\Http\Controllers\Administration\Admin\DashboardController;
use App\Http\Controllers\Administration\Client\ClientController;
use App\Http\Controllers\Administration\Client\ImportClientController;
use App\Http\Controllers\Administration\Email\EmailController;
use App\Http\Controllers\Administration\Import\CSVImportController;
use App\Http\Controllers\Administration\Profil\ProfilController;
use App\Http\Controllers\Administration\Setting\CurrencyController;
use App\Http\Controllers\Administration\Setting\ExpenseCategoryController;
use App\Http\Controllers\Administration\Setting\PaymentMethodController;
use App\Http\Controllers\Administration\Setting\SettingController;
use App\Http\Controllers\Administration\Setting\TaxeController;
use Illuminate\Support\Facades\Route;

Route::get('/admin', [DashboardController::class, 'index'])->name('home');

Route::group(['prefix' => 'auth', 'middleware' => ['role:SuperAdmin']], function () {
    Route::group(['prefix' => 'admins'], function () {
        Route::get('/', [AdminController::class, 'index'])->name('admins');
        Route::get('/create', [AdminController::class, 'create'])->name('admins.create');
        Route::post('/create', [AdminController::class, 'store'])->name('admins.createPost');
        Route::delete('/delete', [AdminController::class, 'delete'])->name('admins.delete');

        Route::get('/edit/{admin}', [AdminController::class, 'edit'])->name('admins.edit');
        Route::post('/edit/{admin}', [AdminController::class, 'update'])->name('admins.update');

        //Route::get('/edit/permissions/{admin}', [AdminController::class, 'edit'])->name('admins.edit');
        Route::post('/edit/permissions/{admin}', [AdminController::class, 'syncPermission'])->name('admins.syncPermissions');
    });
});

Route::group(['prefix' => 'emails'], function () {
    Route::get('/inbox', [EmailController::class, 'index'])->name('emails.inbox');

    Route::group(['prefix' => 'overview'], function () {
        Route::get('/email', [EmailController::class, 'show'])->name('emails.show');
    });
});

Route::group(['prefix' => 'clients'], function () {
    Route::get('/', [ClientController::class, 'index'])->name('clients.index');
    Route::get('/create', [ClientController::class, 'create'])->name('clients.create');
    Route::post('/create', [ClientController::class, 'store'])->name('clients.createPost');
    Route::delete('/delete', [ClientController::class, 'delete'])->name('clients.delete');

    Route::get('/edit/{client}', [ClientController::class, 'edit'])->name('client.edit');
    Route::post('/edit/{client}', [ClientController::class, 'update'])->name('client.update');
    Route::post('/edit/{client}/emails', [ClientController::class, 'addEmails'])->name('client.add.emails');

    Route::post('/edit/{client}/phones', [ClientController::class, 'addPhones'])->name('client.add.phones');

    Route::delete('edit/delete-phone', [ClientController::class, 'deletePhone'])->name('client.delete.phone');
    Route::delete('edit/delete-email', [ClientController::class, 'deleteEmail'])->name('client.delete.email');

    Route::group(['prefix' => 'overview'], function () {
        Route::get('/client/{client}', [ClientController::class, 'show'])->name('clients.show');
    });

    Route::post('/import', [ImportClientController::class, 'import'])->name('clients.import');
});

Route::group(['prefix' => 'files-importers', 'middleware' => 'role:SuperAdmin'], function () {
    Route::get('/csv', [CSVImportController::class, 'index'])->name('files.importers.csv');
});

Route::group(['prefix' => 'profile'], function () {
    Route::get('/', [ProfilController::class, 'index'])->name('profile.index');

    Route::get('/settings', [ProfilController::class, 'settings'])->name('profile.settings');
    Route::post('/settings', [ProfilController::class, 'update'])->name('profile.settings.update');
});

Route::group(['prefix' => 'settings'], function () {
    Route::get('/', [SettingController::class, 'index'])->name('settings.index');
    Route::post('/', [SettingController::class, 'update'])->name('settings.store');

    Route::group(['prefix' => 'emails'], function () {
        Route::get('/{email}', [SettingController::class, 'email'])->name('settings.email.single');
    });

    Route::group(['prefix' => 'invoice'], function () {
        Route::get('/', [SettingController::class, 'invoice'])->name('settings.invoice');
        Route::post('/', [SettingController::class, 'invoiceUpdate'])->name('settings.invoice.store');
    });

    Route::group(['prefix' => 'taxes'], function () {
        Route::get('/', [TaxeController::class, 'index'])->name('settings.taxes');
        Route::post('/', [TaxeController::class, 'store'])->name('settings.taxes.store');
        Route::delete('/', [TaxeController::class, 'delete'])->name('settings.taxes.delete');
    });

    Route::group(['prefix' => 'payment-methods'], function () {
        Route::get('/', [PaymentMethodController::class, 'index'])->name('settings.payment');
        Route::post('/', [PaymentMethodController::class, 'store'])->name('settings.payment.store');
        Route::delete('/', [PaymentMethodController::class, 'delete'])->name('settings.payment.delete');
    });

    Route::group(['prefix' => 'currencies'], function () {
        Route::get('/', [CurrencyController::class, 'index'])->name('settings.currency');
        Route::post('/', [CurrencyController::class, 'store'])->name('settings.currency.store');
        Route::delete('/', [CurrencyController::class, 'delete'])->name('settings.currency.delete');
    });

    Route::group(['prefix' => 'expenses/categories'], function () {
        Route::get('/', [ExpenseCategoryController::class, 'index'])->name('settings.expense');
        Route::post('/', [ExpenseCategoryController::class, 'store'])->name('settings.expense.store');
        Route::delete('/', [ExpenseCategoryController::class, 'delete'])->name('settings.expense.delete');
    });
});
