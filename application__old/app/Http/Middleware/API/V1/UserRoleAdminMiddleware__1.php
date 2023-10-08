<?php

namespace App\Http\Middleware\API\V1;

use App\Exceptions\ForbiddenException;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Symfony\Component\HttpFoundation\Response;

class UserRoleAdminMiddleware__1
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Config::get('user')->role->code === config('constants.user.roles.admin')) {
            return $next($request);
        }

        throw new ForbiddenException('user is not admin.');
    }
}
