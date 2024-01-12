<?php

namespace App\Http\Middleware\API\V1;

use App\Exceptions\ForbiddenException;
use App\Models\Role;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Symfony\Component\HttpFoundation\Response;

class UserAdminOrSelfMiddleware__1
{
    public function handle(Request $request, Closure $next): Response
    {
        // dump(__METHOD__); //DELETE
        // dump($request->user_verification_status); //DELETE
        // $user = $request->route('user');
        // dump($user->uuid); //DELETE
        // dump($user->role->code); //DELETE
        // dump(Config::get('user')->uuid); //DELETE
        // dump(Config::get('user')->role->code); //DELETE
        // dump("is admin: ", Config::get('user')->role->code === Role::$ROLE_CODE_ADMIN); //DELETE
        // dump("is self: ", $request->route('user')->uuid === Config::get('user')->uuid); //DELETE

        if (
            Config::get('user')->role->code === Role::$ROLE_CODE_ADMIN ||
            $request->route('user')->uuid === Config::get('user')->uuid
        ) {
            return $next($request);
        }

        throw new ForbiddenException('Access is denied');
    }
}
