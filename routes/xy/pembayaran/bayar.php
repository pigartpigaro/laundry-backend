<?php

use App\Http\Controllers\Pembayaran\PembayaranController;
use Illuminate\Support\Facades\Route;

Route::group([
    //'middleware' => 'auth:api',
    'prefix' => 'pembayaran/lunas'
], function () {
    // Route::get('/listorder', [TransaksiController::class, 'listorder']);
    Route::post('/savepay', [PembayaranController::class, 'savepay']);
    // Route::post('/deleteorder', [TransaksiController::class, 'deleteorder']);
});
