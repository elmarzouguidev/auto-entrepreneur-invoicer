<?php

use App\Http\Controllers\Authentification\ForgotPasswordController;
use App\Http\Controllers\Authentification\ResetPasswordController;
use App\Http\Controllers\Web\PDFPublicController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::redirect('/', '/app')->name('home');

Route::group(['prefix' => 'views'], function () {
    Route::group(['prefix' => 'invoices'], function () {
        Route::get('/invoice/{invoice}', [PDFPublicController::class, 'showInvoice'])->name('public.show.invoice');
    });

    Route::group(['prefix' => 'invoices-avoir'], function () {
        Route::get('/invoice/{invoice}', [PDFPublicController::class, 'showInvoiceAvoir'])->name('public.show.invoice.avoir');
    });

    Route::group(['prefix' => 'estimates'], function () {
        Route::get('/{estimate}', [PDFPublicController::class, 'showEstimate'])->name('public.show.estimate');
    });

    Route::group(['prefix' => 'bons'], function () {
        Route::get('/{command}', [PDFPublicController::class, 'showBCommand'])->name('public.show.bcommand');
    });
});

Route::group(['prefix' => 'app'], function () {
    Route::get('password/request', [ForgotPasswordController::class, 'showLinkRequestForm'])
        ->middleware('guest')
        ->name('forgotpassword');

    Route::post('password/request', [ForgotPasswordController::class, 'sendResetLinkEmail'])
        ->middleware('guest')
        ->name('forgotpasswordPost');

    Route::get('/password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])
        ->middleware('guest')
        ->name('password.reset');

    Route::post('/password/reset/', [ResetPasswordController::class, 'reset'])
        ->middleware('guest')
        ->name('password.update');
});
