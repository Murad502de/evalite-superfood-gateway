<?php

namespace App\Providers;

use App\Events\emailVerificationCodeRequested;
use App\Events\passwordResetCodeRequested;
use App\Events\PayoutApprovedEvent;
use App\Events\UserApprovedEvent;
use App\Events\UserRegisteredEvent;
use App\Events\UserRejectedEvent;
use App\Listeners\PayoutApprovedListener;
use App\Listeners\sendEmailVerificationCode;
use App\Listeners\sendPasswordResetCode;
use App\Listeners\sendUserRegisteredMailListener;
use App\Listeners\UserApprovedListener;
use App\Listeners\UserRejectedListener;
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
        UserRegisteredEvent::class            => [
            sendUserRegisteredMailListener::class,
        ],
        UserApprovedEvent::class              => [
            UserApprovedListener::class,
        ],
        UserRejectedEvent::class              => [
            UserRejectedListener::class,
        ],
        PayoutApprovedEvent::class            => [
            PayoutApprovedListener::class,
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
