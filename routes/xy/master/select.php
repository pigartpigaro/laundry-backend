<?php

use App\Http\Controllers\Master\SelectController;
use Illuminate\Support\Facades\Route;

Route::group([
    //'middleware' => 'auth:api',
    'prefix' => 'master/select'
], function () {
    Route::get('/satuan-all', [SelectController::class, 'satuan_all']);
    Route::get('/satuan-filter', [SelectController::class, 'satuan_filter']);
    // Route::get('/get-brand', [SelectController::class, 'get_brand']);


    Route::get('/kategori-all', [SelectController::class, 'kategori_all']);

    Route::get('/produk-all', [SelectController::class, 'produk_all']);
    Route::get('/pelanggan-all', [SelectController::class, 'pelanggan_all']);
    // ini untuk select yg lain
    // Route::get('/barang-filter', [SelectController::class, 'barang_filter']);
});
