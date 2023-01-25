<?php

use App\Http\Controllers\Commercial\Buy\BuyBCommandController;
use App\Http\Controllers\Commercial\Buy\BuyEstimateController;
use App\Http\Controllers\Commercial\Buy\BuyInvoiceController;
use App\Http\Controllers\Commercial\Buy\BuyProviderController;
use App\Http\Controllers\Web\BuyPDFPublicController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'invoices', 'middleware' => 'role_or_permission:SuperAdmin|invoices.browse'], function () {
    Route::get('/', [BuyInvoiceController::class, 'index'])->name('invoices.index');
    Route::post('/', [BuyInvoiceController::class, 'store'])->can('invoices.create')->name('invoices.store');

    Route::get('/create', [BuyInvoiceController::class, 'create'])->can('invoices.create')->name('invoices.create');
    Route::post('/create', [BuyInvoiceController::class, 'store'])->can('invoices.create')->name('invoices.store.new');
    Route::delete('/', [BuyInvoiceController::class, 'delete'])->can('invoices.delete')->name('invoices.delete');

    Route::group(['prefix' => 'edit/invoice'], function () {
        Route::get('/{invoice}', [BuyInvoiceController::class, 'edit'])->can('invoices.edit')->name('invoices.edit');
        Route::post('/{invoice}', [BuyInvoiceController::class, 'update'])->can('invoices.edit')->name('invoices.update');
        Route::delete('/delete', [BuyInvoiceController::class, 'deleteArticle'])->can('invoices.delete')->name('invoices.delete.article');
    });

    Route::group(['prefix' => 'view/invoice'], function () {
        Route::get('/{invoice}', [BuyPDFPublicController::class, 'viewInvoice'])->name('invoices.view');
    });
});
Route::group(['prefix' => 'estimates', 'middleware' => 'role_or_permission:SuperAdmin|estimates.browse'], function () {
    Route::get('/', [BuyEstimateController::class, 'index'])->name('estimates.index');
    Route::post('/', [BuyEstimateController::class, 'store'])->can('estimates.create')->name('estimates.store');

    Route::get('/create', [BuyEstimateController::class, 'create'])->can('estimates.create')->name('estimates.create');
    Route::post('/create', [BuyEstimateController::class, 'store'])->can('estimates.create')->name('estimates.store.new');
    Route::delete('/', [BuyEstimateController::class, 'delete'])->can('estimates.delete')->name('estimates.delete');

    Route::group(['prefix' => 'edit/estimate'], function () {
        Route::get('/{estimate}', [BuyEstimateController::class, 'edit'])->can('estimates.edit')->name('estimates.edit');
        Route::post('/{estimate}', [BuyEstimateController::class, 'update'])->can('estimates.edit')->name('estimates.update');
        Route::delete('/delete', [BuyEstimateController::class, 'deleteArticle'])->can('estimates.delete')->name('estimates.delete.article');
    });
});

Route::group(['prefix' => 'bons-commands'], function () {
    Route::get('/', [BuyBCommandController::class, 'indexFilter'])->name('bcommandes.index');
    Route::get('/create', [BuyBCommandController::class, 'create'])->name('bcommandes.create');
    Route::post('/create', [BuyBCommandController::class, 'store'])->name('bcommandes.createPost');
    Route::delete('/', [BuyBCommandController::class, 'deleteCommand'])->name('bcommandes.delete');

    Route::post('/send', [BuyBCommandController::class, 'sendBC'])->name('bcommandes.send');

    Route::group(['prefix' => 'edit/order'], function () {
        Route::get('/{command}', [BuyBCommandController::class, 'edit'])->name('bcommandes.edit');
        Route::post('/{command}', [BuyBCommandController::class, 'update'])->name('bcommandes.update');
        Route::delete('/delete-article', [BuyBCommandController::class, 'deleteArticle'])->name('bcommandes.delete.article');
    });
});

Route::group(['prefix' => 'providers'], function () {
    Route::get('/', [BuyProviderController::class, 'index'])->name('providers.index');
    Route::get('/create', [BuyProviderController::class, 'create'])->name('providers.create');
    Route::post('/create', [BuyProviderController::class, 'store'])->name('providers.createPost');
    Route::delete('/', [BuyProviderController::class, 'delete'])->name('providers.delete');

    Route::group(['prefix' => 'edit/provider'], function () {
        Route::get('/{provider}', [BuyProviderController::class, 'edit'])->name('providers.edit');
        Route::post('/{provider}', [BuyProviderController::class, 'update'])->name('providers.update');
        Route::post('/{provider}/emails', [BuyProviderController::class, 'addEmails'])->name('providers.add.emails');
        Route::post('/{provider}/phones', [BuyProviderController::class, 'addPhones'])->name('providers.add.phones');

        Route::delete('/delete-phone', [BuyProviderController::class, 'deletePhone'])->name('providers.delete.phone');
        Route::delete('/delete-email', [BuyProviderController::class, 'deleteEmail'])->name('providers.delete.email');
    });
});
