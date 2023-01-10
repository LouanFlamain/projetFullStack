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
    protected function setImage($image, $posts)
    {
        $file = null;
        if (isset($image)) {
            $toto = getimagesizefromstring($image);
            $size = strlen($image);
            $tabExtension = explode("image/", $toto['mime']);;
            $extension = strtolower(end($tabExtension));
            $extensions = ['jpg', 'png', 'jpeg', 'gif'];
            $maxSize = 400000;
            if (in_array($extension, $extensions) && $size <= $maxSize) {
                $uniqueName = uniqid('', true);
                $file = $uniqueName . "." . $extension;
                file_put_contents('upload/'.$file, $image);
            }

        }

        $user = (new Post($posts))
            ->setUser_Id($this->getUser()->id)
            ->setImage($file)
            ->setCreated_At();
        
        $manger = new PostManager(new PDOFactory());
        $manger->insertPost($user);

    }

//    protected function setPOST($posts)
//    {
//        //var_dump($post);die;
//        //var_dump(get_class_methods(new Post));
////        $listMethodClass = get_class_methods(new Post);
////        foreach ($listMethodClass as $methodClass){
////            $str = null;
////            //var_dump($methodClass[0]);
////            for ($i = 0; $i <= 2; $i++){
////                $str .= $methodClass[$i];
////                //var_dump($str);
////            }
////            $keyPost = null;
////            for ($i = 3; $i < strlen($methodClass); $i++){
////                $keyPost .= $methodClass[$i];
////                //var_dump($str);
////            }
////            if($str == "set" ){
////
////            }
////            //var_dump($str);
////            //var_dump($str);
////            //var_dump($methodClass);
////        }
//            $listMethodClass = get_class_methods(new Post);
//            foreach ($listMethodClass as $key => $methodClass){
//                $str = null;
//                //var_dump($methodClass[0]);
//                for ($i = 0; $i <= 2; $i++){
//                    $str .= $methodClass[$i];
//                    //var_dump($str);
//                }
//                $keyPost = null;
//                for ($i = 3; $i < strlen($methodClass); $i++){
//                    $keyPost .= $methodClass[$i];
//                    //var_dump($keyPost);
//                }
//                var_dump(array_keys($posts)[$key]);
//                //var_dump(array_search(strtolower($keyPost), array_keys($posts[$key])));
//                //var_dump("key Post ". $key, "key Class " .$keyPost);
//                //var_dump(array_keys($posts));die;
//                foreach ($posts as $key => $value){
//
//                    //var_dump($key == strtolower($keyPost));
////                    var_dump(strtolower($keyPost), $key);
////                    if(strtolower($keyPost) == $key){
////                        var_dump($keyPost);
////                    }
//                }
//                //var_dump(strtolower($keyPost), array_keys($posts));
//                if($data = array_search(strtolower($keyPost), array_keys($posts))){
//                    //var_dump($keyPost);
//                }
//                //var_dump($str);
//                //var_dump($str);
//                //var_dump($methodClass);
//            }
//
//        //var_dump(is_callable([User, getId]));
//    }
    public function renderJSON($content)
    {
        header('Content-Type: application/json');
        echo json_encode($content, JSON_PRETTY_PRINT);
        exit;
    }
}
