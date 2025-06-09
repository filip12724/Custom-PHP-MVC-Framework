<?php
declare (strict_types=1);

namespace App\Controllers;

use Elephant\Framework\Http\Response;

class BookController 
{
    public function show(int $id): Response
    {
        $content = "<h1>This book is number $id </h1>";

        return new Response($content);
    }
}