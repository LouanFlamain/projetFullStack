<?php

use App\Helpers\Utilitaire;
use App\Route\Route;

header("Access-Control-Allow-Origin: http://localhost:3000");
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Allow-Headers: authorization, content-type");
header("Content-Type: application/json");
if ($_SERVER['REQUEST_METHOD'] === "OPTIONS") die;
if (($_SERVER['REQUEST_URI'] != "/login" && $_SERVER['REQUEST_URI'] != "/register") && empty($_COOKIE)) echo json_encode(["token" => false]);

$json = file_get_contents('php://input');
$data = (array)json_decode($json);

require_once 'vendor/autoload.php';

session_start();

$controllerDir = dirname(__FILE__) . '/src/Controller';
$dirs = scandir($controllerDir);

$controllers = [];

foreach ($dirs as $dir) {
    if ($dir === "." || $dir === "..") {
        continue;
    }

    $controllers[] = "App\\Controller\\" . pathinfo($controllerDir . DIRECTORY_SEPARATOR . $dir)['filename'];
}
if($_SERVER['REQUEST_METHOD'] != "GET"){
    $blabla = (array)$data['data'];
    $test = (array)$blabla['attributes'];
    $data['data'] = $blabla;
    $data['attributes'] = $test;

    if(!empty($data['data'])){
        foreach ($data['data']['attributes'] as $key => $post){
            if(is_array($post)){
                foreach($post as $new){
                    $data[$key] = htmlspecialchars($new);
                }
            }else {
                $data[$key] = htmlspecialchars($post);
            }
        }
    }  
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

foreach ($routesObj as $route) {
    if (!$route->match($url) || !in_array($_SERVER['REQUEST_METHOD'], $route->getMethods())) {
        continue;
    }

    $controlerClassName = $route->getController();
    $action = $route->getAction();
    $params = $route->mergeParams($url, $data);
    echo [new $controlerClassName(),$action](...$params);
    exit();
}

die;
