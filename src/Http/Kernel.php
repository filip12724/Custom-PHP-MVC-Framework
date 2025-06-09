<?php 
declare(strict_types=1);

namespace Elephant\Framework\Http;

use FastRoute\RouteCollector;
use function FastRoute\simpleDispatcher;

class Kernel 
{
    public function handle(Request $request): Response 
    {
        $dispatcher = simpleDispatcher(function(RouteCollector $routeCollector){
            $routeCollector->addRoute('GET', '/', function(){
                $content = "<h1>Hello World</h1>";

                return new Response($content);
            });

            $routeCollector->addRoute('GET', '/books/{id:\d+}', function($id){
                $content = "<h1>This book is number $id </h1>";

                return new Response($content);
            });

        });
        $routeInfo = $dispatcher->dispatch(
            $request->getMethod(), 
            $request->getUri(),
        );

        [$status, $handler, $vars] = $routeInfo;
       
        return call_user_func_array($handler, $vars);
    }
}