<?php

namespace Elephant\Framework\Http;

use FastRoute\RouteCollector;
use Elephant\Framework\Controllers\AbstractController;
use Elephant\Framework\Database\Connection;

use function FastRoute\simpleDispatcher;

class Kernel
{
	protected ?Connection $connection = null;
	protected array $routes = [];

	public function __construct()
	{
		$config = include BASE_PATH . '/database/config.php';

		$this->connection = Connection::create($config['connectionString']);
		$this->routes = include BASE_PATH . '/routes/web.php';
	}

	public function handle(Request $request): Response
	{
		Session::start();
		$dispatcher = simpleDispatcher(function (RouteCollector $routeCollector) {

			foreach ($this->routes as $route) {
				[ $method, $path, $handlerArray, $middlewareArray ] = \array_pad($route, 4, []);

				$routeCollector->addRoute($method, $path, [
                    'controller' => $handlerArray,
                    'middleware' => $middlewareArray,
            	]);
			}	
		});

		$routeInfo = $dispatcher->dispatch(
			$request->getMethod(),
			$request->getUri(),
		);

  		if ($routeInfo[0] !== \FastRoute\Dispatcher::FOUND) {
            return new Response('Not Found', 404);
        }

		  [ $_, $data, $vars ] = $routeInfo;

        [ $controllerClass, $methodName ] = $data['controller'];
        $middlewareClasses                = $data['middleware'];

        $core = function(Request $req) use ($controllerClass, $methodName, $vars) {
            $controller = new $controllerClass;
            if ($controller instanceof AbstractController) {
                $controller->setRequest($req);
            }

            return call_user_func_array(
                [$controller, $methodName],
                $vars
            );
        };


        $pipeline = array_reduce(
            array_reverse($middlewareClasses),
            function(callable $next, string $middlewareClass) {
                return function(Request $req) use ($next, $middlewareClass) {
                    $mw = new $middlewareClass;
                    return $mw->handle($req, $next);
                };
            },
            $core
        );
        return $pipeline($request);
	}
}