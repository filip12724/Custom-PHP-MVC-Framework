<?php

namespace Elephant\Framework\Contracts;

use Elephant\Framework\Http\Request;
use Elephant\Framework\Http\Response;

interface MiddlewareInterface 
{
    public function handle(Request $request, callable $next): ResponseInterface;
}