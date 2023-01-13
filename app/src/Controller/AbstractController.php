<?php

namespace App\Controller;

use App\Entity\Post;
use App\Entity\User;
use App\Factory\PDOFactory;
use App\Manager\PostManager;
use App\Helpers\JWTHelper;

abstract class AbstractController
{
//    public function __construct(string $action, array $params = [])
//    {
//        if (!is_callable([$this, $action])) {
//           throw new \RuntimeException("La methode $action n'est pas disponible dans ce controller");
//        }
//        call_user_func_array([$this, $action], $params);
//
//        if(isset($_SESSION)){
//            session_start();
//        }
//    }
//     public function getUser() : ?User {
//         return isset($_SESSION['user']) ? unserialize($_SESSION['user']) : null;
//     }

    public function getUser()
    {
        return JWTHelper::decodeJWT($_COOKIE['token']) ?? null;
    }

    public function render(string $view, array $args = [], string $title = "Document")
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
        $_pageContent = ob_get_clean();
        $_pageTitle = $title;

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
