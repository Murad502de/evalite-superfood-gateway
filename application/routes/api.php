<?php

use App\Http\Controllers\API\V1\AdminAuthController__1;
use App\Http\Controllers\API\V1\ConfirmEmailController__1;
use App\Http\Controllers\API\V1\UserController__1;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    Route::prefix('admin')->group(function () {
        Route::post('signin', [AdminAuthController__1::class, 'signin']);
    });

    Route::prefix('users')->group(function () {
        Route::post('/', [UserController__1::class, 'create']);
        Route::get('my', [UserController__1::class, 'my'])->middleware('user.token');

        Route::prefix('email')->group(function () {
            Route::prefix('confirm')->group(function () {
                Route::post('/', [ConfirmEmailController__1::class, 'confirm']);
                Route::post('code', [ConfirmEmailController__1::class, 'code']);
            });
        });

        Route::prefix('check')->group(function () {
            Route::prefix('invite-code')->group(function () {
                Route::get('/{user:invite_code}', [UserController__1::class, 'check']);
            });
        });

        Route::delete('/{user:uuid}', [UserController__1::class, 'delete']);
    });
});
