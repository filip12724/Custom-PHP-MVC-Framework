<?php
declare (strict_types=1);

namespace App\Controllers;

use App\Models\Book;
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

    public function create(): Response
    {
        return $this->render('create-book.html.twig');
    }

    public function store(): void
    {
        $book = new Book();
        $book->setTitle($this->request->getPostParams('title'));
        $book->setBody($this->request->getPostParams('body'));

        dd($book);
    }
}