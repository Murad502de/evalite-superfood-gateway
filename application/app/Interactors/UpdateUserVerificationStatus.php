<?php

namespace App\Interactors;

use App\Helpers\User\UserVerificationStatusHelper;
use App\Models\User;
use App\Services\User\UserUpdateService;

class UpdateUserVerificationStatus
{
    public function __invoke(User $user, string $status): bool
    {
        if (!UserVerificationStatusHelper::isStatusExist($status)) {
            return false;
        }

        UserUpdateService::update($user, [
            'verification_status' => $status,
        ]);

        return true;
    }
}
