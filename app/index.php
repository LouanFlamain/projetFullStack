<?php

use App\Route\Route;
use App\Traits\FileParser;

header("Access-Control-Allow-Origin: http://localhost:3000");
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Allow-Headers: authorization");
// header("Content-Type: application/json");

session_start();
$id_session = session_id();

require_once 'vendor/autoload.php';

$controllerDir = dirname(__FILE__) . '/src/Controller';
$dirs = scandir($controllerDir);
$controllers = [];

foreach ($dirs as $dir) {

    if ($dir === "." || $dir === "..") {
        continue;
    }

    $controllers[] = "App\\Controller\\" . pathinfo($controllerDir . DIRECTORY_SEPARATOR . $dir)['filename'];
}

$routesObj = [];

foreach ($controllers as $controller) {
    $reflection = new ReflectionClass($controller);
    foreach ($reflection->getMethods() as $method) {
       foreach ($method->getAttributes() as $attribute) {

           /** @var Route $route */
           $route = $attribute->newInstance();

           $route->setController($controller)
                 ->setAction($method->getName());

           $routesObj[] = $route;
       }
    }
}

$url = "/" . trim(explode("?", $_SERVER['REQUEST_URI'])[0], "/");
//  dès qu'on a un match (cf Route.php) => on execute les instructions
foreach ($routesObj as $route) {
    if (!$route->match($url) || !in_array($_SERVER['REQUEST_METHOD'], $route->getMethods())) {

        continue;
    }

    $controlerClassName = $route->getController();
    $action = $route->getAction();
    $params = $route->mergeParams($url);

    new $controlerClassName($action, $params);
    exit();
}
echo 'index.php';
?>
<h1>Welcome !</h1>
<div class="index_div">
    <a href='login'>login</a>
    <a href='register'>register</a>
</div>

