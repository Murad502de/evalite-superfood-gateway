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
        dump(__METHOD__); //DELETE
        $STATUS = $request->user_verification_status;
        //TODO set status
        $updateUserVerificationStatusRes = (new UpdateUserVerificationStatus)($user, $STATUS);

        if (!$updateUserVerificationStatusRes) {
            return false;
        }

        //TODO send notification by status
        $sendStatusNotificationRes = (new SendStatusNotification)($user, $STATUS);

        if (!$sendStatusNotificationRes) {
            return false;
        }

        return true;
    }
}
