<?php 
declare (strict_types=1);

namespace Elephant\Framework\Controllers;

use Elephant\Framework\Http\Request;
use Elephant\Framework\Http\Response;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class AbstractController 
{

    protected ?Request $request = null;

    public function render(string $template, ?array $vars = []): Response
    {
        $templatePath = BASE_PATH . '/views';
        $loader = new FilesystemLoader($templatePath);
        $twig = new Environment($loader);

        $content = $twig->render($template,$vars);

        $response = new Response($content);

        return $response;
    }

    public function setRequest(Request $request): void 
    {
        $this->request = $request;
    }
}