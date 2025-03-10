<?php

use App\Http\Controllers\Master\KategoriController;
use Illuminate\Support\Facades\Route;

Route::group([
    //'middleware' => 'auth:api',
    'prefix' => 'master/kategori'
], function () {
    Route::get('/listdata', [KategoriController::class, 'listdata']);
    Route::post('/savedata', [KategoriController::class, 'savedata']);
    Route::post('/deletedata', [KategoriController::class, 'deletedata']);
});
