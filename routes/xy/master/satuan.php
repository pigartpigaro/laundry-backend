<?php

use App\Http\Controllers\Master\SatuanController;
use Illuminate\Support\Facades\Route;

Route::group([
    //'middleware' => 'auth:api',
    'prefix' => 'master/satuan'
], function () {
    Route::get('/listdata', [SatuanController::class, 'listdata']);
    Route::post('/savedata', [SatuanController::class, 'savedata']);
    Route::post('/deletedata', [SatuanController::class, 'deletedata']);
});
