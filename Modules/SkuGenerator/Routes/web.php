<?php

use Modules\SkuGenerator\Http\Controllers\SkuGeneratorController;

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

Route::prefix('skugenerator')->group(function() {
    Route::get('/create', [SkuGeneratorController::class, 'create'])->name('sku.create');
    Route::post('/generate', [SkuGeneratorController::class, 'generate'])->name('sku.generate');
    Route::get('/export/{cacheKey}', [SkuGeneratorController::class, 'export'])->name('sku.export');
});
