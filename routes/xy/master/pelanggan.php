<?php

use App\Http\Controllers\Master\PelangganController;
use App\Http\Controllers\Master\ProdukController;
use Illuminate\Support\Facades\Route;

Route::group([
    //'middleware' => 'auth:api',
    'prefix' => 'master/pelanggan'
], function () {
    Route::get('/listdata', [PelangganController::class, 'listdata']);
    Route::post('/savedata', [PelangganController::class, 'savedata']);
    Route::post('/deletedata', [PelangganController::class, 'deletedata']);
});
