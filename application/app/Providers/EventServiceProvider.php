<?php

namespace App\Providers;

use App\Events\emailVerificationCodeRequested;
use App\Events\passwordResetCodeRequested;
use App\Listeners\sendEmailVerificationCode;
use App\Listeners\sendPasswordResetCode;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        emailVerificationCodeRequested::class => [
            sendEmailVerificationCode::class,
        ],
        passwordResetCodeRequested::class     => [
            sendPasswordResetCode::class,
        ],
    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {}

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
