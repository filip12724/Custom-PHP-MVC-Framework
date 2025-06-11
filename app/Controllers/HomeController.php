<?php
declare (strict_types=1);

namespace App\Controllers;

use Elephant\Framework\Controllers\AbstractController;
use Elephant\Framework\Http\Response;

class HomeController extends AbstractController
{
    public function index(): Response
    {
        return $this->render('home.html.twig');
    }
}