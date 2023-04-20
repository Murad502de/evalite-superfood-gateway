<?php

use App\Http\Controllers\API\V1\ConfirmEmailController__1;
use App\Http\Controllers\API\V1\UserController__1;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    Route::prefix('signup')->group(function () {
        Route::post('/', [UserController__1::class, 'create']);

        Route::prefix('email')->group(function () {
            Route::prefix('confirm')->group(function () {
                Route::post('/', [ConfirmEmailController__1::class, 'confirm']);
                Route::post('code', [ConfirmEmailController__1::class, 'code']);
            });
        });
    });
});
