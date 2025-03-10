<?php

use App\Http\Controllers\Order\TransaksiController;
use Illuminate\Support\Facades\Route;

Route::group([
    //'middleware' => 'auth:api',
    'prefix' => 'order/transaksi'
], function () {
    Route::get('/listorder', [TransaksiController::class, 'listorder']);
    Route::post('/saveorder', [TransaksiController::class, 'saveorder']);
    Route::post('/deleteorder', [TransaksiController::class, 'deleteorder']);
});
