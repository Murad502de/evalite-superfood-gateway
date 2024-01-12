<?php

namespace App\UseCases;

use App\Interactors\UpdateUserVerificationStatus;
use App\Models\User;
use Illuminate\Http\Request;

class SetUserVerificationStatus
{
    public function __invoke(User $user, Request $request): bool
    {
        dump(__METHOD__); //DELETE
        //TODO set status
        $updateUserVerificationStatusRes = (new UpdateUserVerificationStatus)($user, $request->user_verification_status);

        //TODO send notification
        if (!$updateUserVerificationStatusRes) return false;

        return true;
    }
}
