<?php

use App\Http\Controllers\Administration\Invoice\PDFBuilderController;

use App\Http\Controllers\Commercial\Bill\BillController;
use App\Http\Controllers\Commercial\Estimate\EstimateController;
use App\Http\Controllers\Commercial\Invoice\InvoiceController;

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'invoices', 'middleware' => 'role_or_permission:SuperAdmin|invoices.browse'], function () {
    Route::get('/', [InvoiceController::class, 'indexFilter'])->name('invoices.index');

    Route::get('/create', [InvoiceController::class, 'create'])->can('invoices.create')->name('invoices.create');
    Route::post('/create', [InvoiceController::class, 'store'])->can('invoices.create')->name('invoices.store');
    Route::delete('/', [InvoiceController::class, 'deleteInvoice'])->can('invoices.delete')->name('invoices.delete');

    Route::post('/send', [InvoiceController::class, 'sendInvoice'])->name('invoices.send');

    Route::group(['prefix' => 'overview/invoice'], function () {
        Route::get('/{invoice}', [InvoiceController::class, 'single'])->name('invoices.single');
    });

    Route::group(['prefix' => 'edit/invoice'], function () {
        Route::get('/{invoice}', [InvoiceController::class, 'edit'])->can('invoices.edit')->name('invoices.edit');
        Route::post('/{invoice}', [InvoiceController::class, 'update'])->can('invoices.edit')->name('invoices.update');
        Route::delete('/delete', [InvoiceController::class, 'deleteArticle'])->can('invoices.delete')->name('invoices.delete.article');
    });

    Route::group(['prefix' => 'PDF/invoice'], function () {
        Route::get('/{invoice}', [PDFBuilderController::class, 'build'])->name('invoices.pdf.build');
    });

});

Route::group(['prefix' => 'bills'], function () {
    Route::get('/', [BillController::class, 'index'])->name('bills.index');
    Route::post('/', [BillController::class, 'store'])->name('bills.store.normal');

    Route::delete('/delete', [BillController::class, 'deleteBill'])->name('bills.delete');

    Route::group(['prefix' => 'bill/invoice'], function () {
        Route::get('/{invoice}', [BillController::class, 'addBill'])->name('bills.addBill');
        Route::post('/{invoice}', [BillController::class, 'storeBill'])->name('bills.storeBill');
    });

    Route::group(['prefix' => 'bill/edit'], function () {
        Route::get('/{bill}', [BillController::class, 'edit'])->name('bills.edit');
        Route::post('/{bill}', [BillController::class, 'update'])->name('bills.update');
    });

    Route::group(['prefix' => 'bill/create'], function () {
        Route::get('/', [BillController::class, 'create'])->name('bills.create');
        Route::post('/', [BillController::class, 'storeBill'])->name('bills.store');
    });
});

Route::group(['prefix' => 'estimates'], function () {

    Route::get('/', [EstimateController::class, 'indexFilter'])->name('estimates.index');

    Route::get('/create', [EstimateController::class, 'create'])->name('estimates.create');
    Route::post('/create', [EstimateController::class, 'store'])->name('estimates.store');
    Route::delete('/', [EstimateController::class, 'deleteEstimate'])->name('estimates.delete');

    Route::post('/send', [EstimateController::class, 'sendEstimate'])->name('estimates.send');

    Route::group(['prefix' => 'overview/estimate'], function () {
        Route::get('/{estimate}', [EstimateController::class, 'single'])->name('estimates.single');
    });

    Route::group(['prefix' => 'edit/estimate'], function () {
        Route::get('/{estimate}', [EstimateController::class, 'edit'])->name('estimates.edit');
        Route::post('/{estimate}', [EstimateController::class, 'update'])->name('estimates.update');
        Route::delete('/delete', [EstimateController::class, 'deleteArticle'])->name('estimates.delete.article');

        Route::put('/articles', [EstimateController::class, 'updateArticle'])->name('estimates.update.article');
    });

    Route::group(['prefix' => 'estimate/create-invoice'], function () {
        Route::get('/{estimate}', [EstimateController::class, 'createInvoice'])->name('estimates.create.invoice');
    });
});
