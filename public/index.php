<?php 
declare(strict_types=1);

use Elephant\Framework\Http\Request;

define('BASE_PATH', dirname(__DIR__));

require_once BASE_PATH . '/vendor/autoload.php';

$request = Request::create();
dd($request); 
echo "Hello world";