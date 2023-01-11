<?php

namespace App\Controller;

use App\Entity\User;
use App\Factory\PDOFactory;
use App\Helpers\JWTHelper;
use App\Helpers\Utilitaire;
use App\Manager\UserManager;
use App\Route\Route;


class AuthController extends AbstractController
{
    /* #[Route('/login', name: "login", methods: ["POST"])]
    public function login()
    {
        if(!empty($_POST)) {
            $verify = false;

            $formUsername = $_POST['username'];
            $formPwd = $_POST['password'];

            $userManager = (new UserManager(new PDOFactory()))
                ->getByUsername($formUsername);

<<<<<<< HEAD
            // $userManager->getHashedPassword();
            // var_dump($userManager->getHashedPassword());
            if(password_verify($formPwd, $userManager->getHashedPassword()))
            {
                $verify = true;

                $jwt = JWTHelper::buildJWT($userManager);
                $decoded = JWTHelper::decodeJWT($jwt);

                setcookie('token', $jwt, time()+1800, '/','localhost', false, false);

                echo($_COOKIE['token']);

                return $this->renderJSON([
                    'login' => 'verify',
                    "token" => $jwt,
                    "decoded" => $decoded,
                    "user" => [(array)$userManager]
                ]);
            }
        
=======

>>>>>>> jugurta
        }
    } */
    
<<<<<<< HEAD
=======
   /* #[Route('/login', name: "showlogin", methods: ["GET"])]
    public function showLogin()
    {
        return $this->render("register&login/formLogin.php");

    }*/

>>>>>>> jugurta

    #[Route('/register', name: "register", methods: ["POST"])]
    public function register(): void
    {
        /** @var App\Entity\User $user */

        $user = (new User($_POST))->setAccess('User')->passwordHash($_POST['password']);

        if($user->getUsername() && $user->getPassword()){
            $userManager = new UserManager(new PDOFactory());
            $userManager->insertUser($user);

            echo json_encode(["register" => true]);
        }
        else{
            echo json_encode(["register" => false]);
        }
    }


}
