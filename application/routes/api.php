<?php

use App\Http\Controllers\API\V1\AdminAuthController__1;
use App\Http\Controllers\API\V1\AuthController__1;
use App\Http\Controllers\API\V1\ConfigurationController__1;
use App\Http\Controllers\API\V1\ConfirmEmailController__1;
use App\Http\Controllers\API\V1\PayoutController__1;
use App\Http\Controllers\API\V1\ServicesAmoCrmController__1;
use App\Http\Controllers\API\V1\UserController__1;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    Route::prefix('admin')->group(function () { //DELETE
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
            Route::get('/', [UserController__1::class, 'users']);
            Route::get('my', [UserController__1::class, 'my']);
            Route::get('income', [UserController__1::class, 'getUserIncome']);
            Route::prefix('sales')->group(function () {
                Route::get('/', [UserController__1::class, 'getUserSales']);
                Route::get('directs', [UserController__1::class, 'getUserSalesDirects']);
                Route::get('bonusses', [UserController__1::class, 'getUserSalesBonusses']);
                Route::post('payout', [UserController__1::class, 'payoutUserSales']);
            });
            Route::prefix('payouts')->group(function () {
                Route::get('/', [UserController__1::class, 'getUserPayouts']);
                Route::prefix('{payout:uuid}')->group(function () {
                    Route::get('/', [UserController__1::class, 'getUserPayout']);
                });
            });
            Route::prefix('{user:uuid}')->group(function () {
                Route::get('/', [UserController__1::class, 'userDetail']);
                Route::post('/', [UserController__1::class, 'update']);
                Route::delete('/', [UserController__1::class, 'delete']);
                Route::prefix('docs')->group(function () {
                    Route::prefix('agency-contract')->group(function () {
                        Route::get('/', [UserController__1::class, 'getAgencyContract']);
                        Route::post('/', [UserController__1::class, 'addAgencyContract']);
                    });
                });

                // Route::prefix('sales')->group(function () { //DELETE//FIXME
                //     Route::get('/', [UserController__1::class, 'getUserSales']);
                //     Route::get('directs', [UserController__1::class, 'getUserSalesDirect']);
                //     Route::get('bonusses', [UserController__1::class, 'getUserSalesBonus']);
                //     Route::post('payout', [UserController__1::class, 'payoutUserSales']);
                // });
                // Route::prefix('payouts')->group(function () { //DELETE//FIXME
                //     Route::get('/', [UserController__1::class, 'getUserPayouts']);
                //     Route::prefix('{payout:uuid}')->group(function () {
                //         Route::get('/', [UserController__1::class, 'getUserPayout']);
                //     });
                // });
            });
        });
    });
    Route::prefix('services')->group(function () {
        Route::prefix('amocrm')->group(function () {
            Route::prefix('auth')->group(function () {
                Route::get('signin', [ServicesAmoCrmController__1::class, 'signin']);
                Route::get('signout', [ServicesAmoCrmController__1::class, 'signout']);
            });
            Route::prefix('webhooks')->group(function () {
                Route::prefix('leads')->group(function () {
                    Route::post('/', [ServicesAmoCrmController__1::class, 'webhookLead']);
                });
            });
        });
    });
    Route::middleware(['user.token', 'user.role.admin'])->group(function () {
        Route::prefix('payouts')->group(function () {
            Route::get('/', [PayoutController__1::class, 'getPayouts']);
            Route::prefix('{payout:uuid}')->group(function () {
                Route::get('/', [PayoutController__1::class, 'getPayout']);
                Route::post('payout', [PayoutController__1::class, 'payout']);
            });
        });
        Route::prefix('configurations')->group(function () {
            Route::post('/', [ConfigurationController__1::class, 'create']);
            Route::get('/', [ConfigurationController__1::class, 'read']);
            Route::put('/', [ConfigurationController__1::class, 'update']);
            Route::delete('/', [ConfigurationController__1::class, 'delete']);
        });
    });

    Route::middleware(['user.token', 'user.admin_or_self'])->group(function () {
        Route::prefix('users')->group(function () {
            Route::prefix('{user:uuid}')->group(function () {
                Route::prefix('status')->group(function () {
                    Route::post('verification', [UserController__1::class, 'setUserStatusVerification']);
                });
            });
        });
    });

    Route::prefix('auth')->group(function () {
        Route::post('signup', [AuthController__1::class, 'signup']);
    });
});
