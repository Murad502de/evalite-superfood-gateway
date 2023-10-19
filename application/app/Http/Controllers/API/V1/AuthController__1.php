<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\V1\SignupRequest__1;
use App\Services\Auth\SignupService;
use Illuminate\Http\Response;

class AuthController__1 extends Controller
{
    public function signup(SignupRequest__1 $request)
    {
        $user = (new SignupService)($request);
        return response()->json(['data' => $user], Response::HTTP_OK);
    }
}
