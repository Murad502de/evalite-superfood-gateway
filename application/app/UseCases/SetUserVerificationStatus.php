<?php

namespace App\UseCases;

use App\Models\User;
use Illuminate\Http\Request;

class SetUserVerificationStatus
{
    public function __invoke(User $user, Request $request): void
    {
        dump(__METHOD__); //DELETE
        // dump($user); //DELETE
        // dump($request); //DELETE

        //TODO set status
        //TODO send notification
    }
}
