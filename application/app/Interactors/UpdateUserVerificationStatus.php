<?php

namespace App\Interactors;

use App\Models\User;

class UpdateUserVerificationStatus
{
    public function __invoke(User $user, string $status): bool
    {
        dump(__METHOD__); //DELETE
        // dump($user); //DELETE
        dump($status); //DELETE

        //TODO check status
        //TODO update user throw service

        return true;
    }
}
