<?php

namespace Elephant\Framework\Middleware;

use Elephant\Framework\Contracts\MiddlewareInterface;
use Elephant\Framework\Http\Request;
use Elephant\Framework\Http\Response;
use Elephant\Framework\Http\Session;
use Elephant\Framework\Http\RedirectResponse;

class AuthMiddleware implements MiddlewareInterface 
{
    public function handle(Request $request, callable $next): RedirectResponse
    {
        if(!Session::has('user')){
            return new RedirectResponse('/login',404);
        }
        return $next($request);
    }
}