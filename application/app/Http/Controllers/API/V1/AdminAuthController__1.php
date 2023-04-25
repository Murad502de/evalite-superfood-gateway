<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\V1\AdminAuthSigninRequest;
use App\Models\User;

class AdminAuthController__1 extends Controller
{
    public function signin(AdminAuthSigninRequest $request)
    {
        $user = User::where('email', $request->email)->first();

        return [
            'uuid'  => $user->uuid,
            'token' => $user->token,
        ];
    }
}
