<?php

namespace App\Controller;

use App\Entity\User;
use App\Helpers\JWTHelper;

abstract class AbstractController
{
    public function getUser()
    {
        return new User((array)JWTHelper::decodeJWT($_COOKIE['token']));
    }

    public function render(string $view, array $args = [])
    {
        $view = dirname(__DIR__, 2) . '/views/' . $view;
        $base = dirname(__DIR__, 2) . '/views/base.php';

        ob_start();
        if(isset($args)){
            foreach ($args as $key => $value) {
                ${$key} = $value;
            }
        }
        unset($args);

        require_once $view;

        ob_start();
        require_once $base;

        return ob_get_clean();
    }

    public function renderJSON($content)
    {
        header('Content-Type: application/json');
        $array = [];
        foreach($content as $key => $data){
            var_dump($key, $data);
        }
        die;
        echo json_encode($content, JSON_PRETTY_PRINT);
        exit;
    }
}
