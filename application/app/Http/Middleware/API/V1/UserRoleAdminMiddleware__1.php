<?php

namespace App\Http\Middleware\API\V1;

use App\Exceptions\ForbiddenException;
use App\Models\Role;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Symfony\Component\HttpFoundation\Response;

class UserRoleAdminMiddleware__1
{
    public function handle(Request $request, Closure $next): Response
    {
        if (Config::get('user')->role->code === Role::$ROLE_CODE_ADMIN) {
            return $next($request);
        }

        throw new ForbiddenException('user is not admin.');
    }
}
