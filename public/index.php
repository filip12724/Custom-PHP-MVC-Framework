<?php 
declare(strict_types=1);

use Elephant\Framework\Http\Kernel;
use Elephant\Framework\Http\Request;
use Elephant\Framework\Http\Response;

define('BASE_PATH', dirname(__DIR__));

require_once BASE_PATH . '/vendor/autoload.php';

$request = Request::create();

$kernel = new Kernel();

$response = $kernel->handle($request);

$response->send();