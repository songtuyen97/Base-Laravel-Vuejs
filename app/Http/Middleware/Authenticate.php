<?php

namespace App\Http\Middleware;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Support\Str;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param \Illuminate\Http\Request $request
     * @return string
     *
     * @throws AuthenticationException
     */
    protected function redirectTo($request)
    {
        if (Str::startsWith($request->path(), ['api/', 'oauth/']) || $request->expectsJson()) {
            throw new AuthenticationException();
        }

        return route('login');
    }
}
