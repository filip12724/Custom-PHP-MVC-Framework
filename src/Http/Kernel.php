<?php 
declare(strict_types=1);

namespace Elephant\Framework\Http;

use Elephant\Framework\Controllers\AbstractController;
use FastRoute\RouteCollector;
use function FastRoute\simpleDispatcher;

class Kernel 
{
    public function handle(Request $request): Response 
    {
        $dispatcher = simpleDispatcher(function(RouteCollector $routeCollector){
            $routes = include BASE_PATH . '/routes/web.php';

            foreach ($routes as $route) {
                $routeCollector->addRoute(...$route);
            }
        });

        $routeInfo = $dispatcher->dispatch(
            $request->getMethod(), 
            $request->getUri(),
        );

        [$status, [$controller, $method], $vars] = $routeInfo;
       
        $controller = new $controller;

        if($controller instanceof AbstractController){
            $controller->setRequest($request);
        }
        
        return call_user_func_array([$controller, $method], $vars);
    }
}