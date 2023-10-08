<?php

namespace App\Http\Middleware\API\V1;

use App\Exceptions\ForbiddenException;
use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

class UserTokenMiddleware__1
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param \Closure $next
     * @return mixed
     * @throws ForbiddenException
     */
    public function handle(Request $request, Closure $next): mixed
    {
        if ($request->bearerToken()) {
            $user = User::whereToken($request->bearerToken())->first();

            if ($user) {
                $user->updated_at = date('Y-m-d H:i:s');
                $user->save();
                Config::set('user', $user);
                return $next($request);
            }
        }

        throw new ForbiddenException('Token is not valid.');
    }
}
