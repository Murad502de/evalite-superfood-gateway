<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController__1 extends Controller
{
    public function signup(Request $request)
    {
        dump($request->all()); //DELETE

        return 'signup';
    }
}
