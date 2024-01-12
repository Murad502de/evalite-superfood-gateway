<?php

namespace App\Interactors;

use App\Events\UserApprovedEvent;
use App\Events\UserRejectedEvent;
use App\Models\User;

class SendStatusNotification
{
    public function __invoke(User $user, string $status): bool
    {
        switch ($status) {
            case User::VERIFICATION_STATUS_CODE_VERIFIED:
                event(new UserApprovedEvent($user));
                return true;
            case User::VERIFICATION_STATUS_CODE_NOT_VERIFIED:
                return true;
            case User::VERIFICATION_STATUS_CODE_WAITING:
                return true;
            case User::VERIFICATION_STATUS_CODE_REJECTED:
                event(new UserRejectedEvent($user));
                return true;
            case User::VERIFICATION_STATUS_CODE_TO_UPDATE:
                return true;
            default:
                return false;
        }
    }
}
