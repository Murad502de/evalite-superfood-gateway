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
        Route::prefix('email')->group(function () {
            Route::prefix('confirm')->group(function () {
                Route::post('/', [ConfirmEmailController__1::class, 'confirm']);
                Route::post('code', [ConfirmEmailController__1::class, 'code']);
            });
        });
        Route::prefix('password')->group(function () {
            Route::put('/', [UserController__1::class, 'passwordUpdate']);
            Route::prefix('reset')->group(function () {
                Route::post('/', [UserController__1::class, 'passwordReset']);
                Route::post('confirm', [UserController__1::class, 'passwordResetConfirm']);
            });
        });
        Route::prefix('check')->group(function () {
            Route::prefix('invite-code')->group(function () {
                Route::get('{user:invite_code}', [UserController__1::class, 'check']);
            });
            Route::prefix('uuid')->group(function () {
                Route::get('{user:uuid}', [UserController__1::class, 'check']);
            });
            Route::prefix('email')->group(function () {
                Route::get('{user:email}', [UserController__1::class, 'check']);
            });
        });
        Route::middleware(['user.token'])->group(function () {
            Route::get('my', [UserController__1::class, 'my']);
            Route::prefix('{user:uuid}')->group(function () {
                Route::delete('/', [UserController__1::class, 'delete']);
                Route::prefix('docs')->group(function () {
                    Route::get('agency-contract', [UserController__1::class, 'getAgencyContract'])->withoutMiddleware('user.token');
                });
            });
        });
    });
});
