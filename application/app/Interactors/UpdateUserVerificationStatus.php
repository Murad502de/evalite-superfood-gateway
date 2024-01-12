<?php

namespace App\Interactors;

use App\Helpers\User\UserVerificationStatusHelper;
use App\Models\User;
use App\Services\User\UserUpdateService;

class UpdateUserVerificationStatus
{
    public function __invoke(User $user, string $status): bool
    {
        dump(__METHOD__); //DELETE
        // dump($user); //DELETE
        dump($status); //DELETE

        //TODO check status
        if (!UserVerificationStatusHelper::isStatusExist($status)) {
            return false;
        }

        //TODO update user throw service
        UserUpdateService::update($user, [
            'verification_status' => $status,
        ]);

        return true;
    }
}
