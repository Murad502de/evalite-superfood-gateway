<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\V1\SignupRequest__1;

class AuthController__1 extends Controller
{
    public function signup(SignupRequest__1 $request)
    {
        return 'AuthController__1/signup';
    }
}
