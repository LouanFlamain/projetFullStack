<?php

namespace App\Controller;

use App\Helpers\JWTHelper;

abstract class AbstractController
{
    public function getUser()
    {
        return JWTHelper::decodeJWT($_COOKIE['token']) ?? null;
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

    /**
     * @param string $file
     * @return string[]
     */
   
    public function renderJSON($content)
    {
        header('Content-Type: application/json');
        echo json_encode($content, JSON_PRETTY_PRINT);
        exit;
    }
}
