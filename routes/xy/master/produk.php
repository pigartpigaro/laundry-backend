<?php

use App\Http\Controllers\Master\ProdukController;
use Illuminate\Support\Facades\Route;

Route::group([
    //'middleware' => 'auth:api',
    'prefix' => 'master/produk'
], function () {
    Route::get('/listdata', [ProdukController::class, 'listdata']);
    Route::post('/savedata', [ProdukController::class, 'savedata']);
    Route::post('/deletedata', [ProdukController::class, 'deletedata']);
});
