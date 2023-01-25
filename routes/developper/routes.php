<?php

//use Spatie\Health\Http\Controllers\HealthCheckResultsController;
use App\Http\Controllers\Developper\DevController;
use Illuminate\Support\Facades\Route;

Route::get('/clear-tables', [DevController::class, 'clearTables'])->name('truncateModels');
Route::get('/link', [DevController::class, 'storageLink']);
Route::get('/unlink', [DevController::class, 'storageUnLink']);

Route::get('/migrate', [DevController::class, 'migrateAll']);
Route::get('/migrate-fresh', [DevController::class, 'migrateFresh']);
Route::get('/seed', [DevController::class, 'migrateSeed']);

Route::get('/cache', [DevController::class, 'cacheAll']);
Route::get('/clear', [DevController::class, 'cleareAll']);

Route::get('/app-up', [DevController::class, 'appUp']);
Route::get('/app-down', [DevController::class, 'appDown']);

Route::get('/installer', [DevController::class, 'installer']);

Route::get('/livewire-config', [DevController::class, 'livewireConfig']);
Route::get('/livewire-assets', [DevController::class, 'livewireAssets']);
Route::get('/livewire-discover', [DevController::class, 'livewireDiscover']);

//Route::get('health', HealthCheckResultsController::class);

Route::get('/composer-dump', [DevController::class, 'composerDump']);
Route::get('/composer-update', [DevController::class, 'composerUpdate']);
