<?php
declare(strict_types=1);

return [
    ['GET', '/', [HomeController::class, 'index']],
    ['GET', '/books/{id:\d+}', [BookController::class, 'show']]
];
