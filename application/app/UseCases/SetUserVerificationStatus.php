<?php

namespace App\UseCases;

use App\Interactors\SendStatusNotification;
use App\Interactors\UpdateUserVerificationStatus;
use App\Models\User;
use Illuminate\Http\Request;

class SetUserVerificationStatus
{
    public function __invoke(User $user, Request $request): bool
    {
        $STATUS = $request->user_verification_status;

        if (!(new UpdateUserVerificationStatus)($user, $STATUS)) {
            return false;
        }

        if (!(new SendStatusNotification)($user, $STATUS)) {
            return false;
        }

        return true;
    }
}
