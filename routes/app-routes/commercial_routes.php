<?php

use App\Http\Controllers\Administration\Invoice\PDFBuilderController;
use App\Http\Controllers\Administration\Report\ReportController;
use App\Http\Controllers\Catalog\BrandController;
use App\Http\Controllers\Catalog\CategoryController;
use App\Http\Controllers\Catalog\ProductController;
use App\Http\Controllers\Commercial\Bill\BillController;
use App\Http\Controllers\Commercial\Estimate\EstimateController;
use App\Http\Controllers\Commercial\Invoice\InvoiceController;
use App\Http\Controllers\Commercial\InvoiceAvoir\InvoiceAvoirController;
use App\Http\Controllers\Statistics\SellsController;
use App\Http\Controllers\Statistics\TaxesController;
use App\Http\Controllers\Stock\AdjustmentController;
use App\Http\Controllers\Stock\CityController;
use App\Http\Controllers\Stock\WarehouseController;
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

    Route::group(['prefix' => 'invoices-avoir'], function () {
        Route::get('/', [InvoiceAvoirController::class, 'index'])->name('invoices.index.avoir');
        Route::get('/create', [InvoiceAvoirController::class, 'create'])->can('invoices.create')->name('invoices.create.avoir');
        Route::post('/create', [InvoiceAvoirController::class, 'store'])->can('invoices.create')->name('invoices.store.avoir');
        Route::delete('/', [InvoiceAvoirController::class, 'deleteInvoice'])->can('invoices.delete')->name('invoices.delete.avoir');

        Route::post('/send', [InvoiceAvoirController::class, 'sendInvoiceAvoir'])->name('invoices.send.avoir');

        Route::group(['prefix' => 'overview/invoice'], function () {
            Route::get('/{invoice}', [InvoiceAvoirController::class, 'single'])->name('invoices.single.avoir');
        });

        Route::group(['prefix' => 'edit/invoices-avoir'], function () {
            Route::get('/{invoice}', [InvoiceAvoirController::class, 'edit'])->can('invoices.edit')->name('invoices.edit.avoir');
            Route::post('/{invoice}', [InvoiceAvoirController::class, 'update'])->can('invoices.edit')->name('invoices.update.avoir');
            Route::delete('/delete', [InvoiceAvoirController::class, 'deleteArticle'])->can('invoices.delete')->name('invoices.delete.article.avoir');
        });

        Route::group(['prefix' => 'PDF/invoices-avoir'], function () {
            Route::get('/{invoice}', [PDFBuilderController::class, 'buildAvoir'])->name('invoices.pdf.build.avoir');
        });
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

    Route::group(['prefix' => 'bill/invoice-avoir'], function () {
        Route::get('/{invoice}', [BillController::class, 'addBillAvoir'])->name('bills.addBill.avoir');
        Route::post('/{invoice}', [BillController::class, 'storeBillAvoir'])->name('bills.storeBill.avoir');
        Route::delete('/delete', [BillController::class, 'delete'])->name('bills.delete.avoir');
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

    Route::group(['prefix' => 'estimate/create-from-ticket'], function () {
        Route::get('/{ticket}', [EstimateController::class, 'createFromTicket'])->name('estimates.create.ticket');
    });
});

Route::group(['prefix' => 'reports'], function () {
    Route::get('/', [ReportController::class, 'index'])->name('reports.index');

    Route::group(['prefix' => 'overview/report'], function () {
        Route::get('/{client}', [ReportController::class, 'single'])->name('reports.single');
    });
});

Route::group(['prefix' => 'catalog'], function () {
    Route::group(['prefix' => 'categories'], function () {
        Route::get('/', [CategoryController::class, 'index'])->name('categories');
        Route::post('/', [CategoryController::class, 'store'])->name('categories.store');
        Route::delete('/', [CategoryController::class, 'delete'])->name('categories.delete');
    });

    Route::group(['prefix' => 'brands'], function () {
        Route::get('/', [BrandController::class, 'index'])->name('brands');
        Route::post('/', [BrandController::class, 'store'])->name('brands.store');
        Route::delete('/', [BrandController::class, 'delete'])->name('brands.delete');
    });

    Route::group(['prefix' => 'products'], function () {
        Route::get('/', [ProductController::class, 'index'])->name('products');
        Route::post('/', [ProductController::class, 'store'])->name('products.store');
        Route::delete('/', [ProductController::class, 'delete'])->name('products.delete');

        Route::group(['prefix' => 'edit/product'], function () {
            Route::get('/{product}', [ProductController::class, 'edit'])->name('products.edit');
            Route::post('/{product}', [ProductController::class, 'update'])->name('products.update');
        });
    });
});

Route::group(['prefix' => 'statistics'], function () {
    Route::group(['prefix' => 'taxes'], function () {
        Route::get('/', [TaxesController::class, 'index'])->name('taxes');
        Route::post('/', [TaxesController::class, 'store'])->name('taxes.store');
        Route::delete('/', [TaxesController::class, 'delete'])->name('taxes.delete');
    });
    Route::group(['prefix' => 'sells'], function () {
        Route::get('/', [SellsController::class, 'index'])->name('sells');
        Route::post('/', [SellsController::class, 'store'])->name('sells.store');
        Route::delete('/', [SellsController::class, 'delete'])->name('sells.delete');
    });
});

Route::group(['prefix' => 'stocks'], function () {
    Route::group(['prefix' => 'warehouses'], function () {
        Route::get('/', [WarehouseController::class, 'index'])->name('warehouses');
        Route::post('/', [WarehouseController::class, 'store'])->name('warehouses.store');
        Route::delete('/', [WarehouseController::class, 'delete'])->name('warehouses.delete');
    });

    Route::group(['prefix' => 'adjustments'], function () {
        Route::get('/', [AdjustmentController::class, 'index'])->name('adjustments');
        Route::post('/', [AdjustmentController::class, 'store'])->name('adjustments.store');
        Route::delete('/', [AdjustmentController::class, 'delete'])->name('adjustments.delete');
    });

    Route::group(['prefix' => 'cities'], function () {
        Route::get('/', [CityController::class, 'index'])->name('cities');
        Route::post('/', [CityController::class, 'store'])->name('cities.store');
        Route::delete('/', [CityController::class, 'delete'])->name('cities.delete');
    });
});
