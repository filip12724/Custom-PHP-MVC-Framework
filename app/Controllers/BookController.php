<?php
declare (strict_types=1);

namespace App\Controllers;

use Elephant\Framework\Controllers\AbstractController;
use Elephant\Framework\Http\Response;

class BookController extends AbstractController
{
    public function show(int $id): Response
    {

        return $this->render('book.html.twig',[
            'id' => $id,
        ]);
    }
}