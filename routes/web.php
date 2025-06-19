<?php
declare(strict_types=1);

use App\Controllers\HomeController;
use App\Controllers\BookController;
use Elephant\Framework\Middleware\AuthMiddleware;

return [
    // public
    ['GET',  '/',                [HomeController::class, 'index']],
    // protected:
    ['GET',  '/books/create',    [BookController::class, 'create'],  [AuthMiddleware::class]],
    ['POST', '/books',           [BookController::class, 'store'],   [AuthMiddleware::class]],
];