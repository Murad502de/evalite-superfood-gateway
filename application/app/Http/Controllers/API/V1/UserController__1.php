<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserController__1 extends Controller
{
    public function create(Request $request)
    {
        $user = User::createNew($request->all());

        return response()->json(['message' => 'success'], Response::HTTP_OK);
    }
    public function delete(User $user)
    {
        $user->delete();

        return response()->json(['message' => 'success'], Response::HTTP_OK);
    }
}
