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
    #[Route('/login', name: "login", methods: ["POST"])]
    public function login()
    {
        if(!empty($_POST)) {
            $verify = false;

            $formUsername = $_POST['username'];
            $formPwd = $_POST['password'];

            $userManager = (new UserManager(new PDOFactory()))
                ->getByUsername($formUsername);

            if(password_verify($formPwd, $userManager->getHashedPassword()))
            {
                $verify = true;

                $jwt = JWTHelper::buildJWT($userManager);
                $decoded = JWTHelper::decodeJWT($jwt);

                setcookie('token', $jwt, time()+1800, '/','localhost', false, false);

                return $this->renderJSON([
                    'login' => 'verify',
                    "token" => $jwt,
                    "decoded" => $decoded,
                    "user" => [
                        'username' => $userManager->getUsername(),
                        'mail' => $userManager->getMail(),
                        'role' => $userManager->getRole()
                    ]
                ]);
            }
        
        }
    }
    

    #[Route('/register', name: "register", methods: ["POST"])]
    public function register(): void
    {
        /** @var App\Entity\User $user */

        $user = (new User($_POST))->passwordHash($_POST['password']);

        if($user->getUsername() && $user->getHashedPassword()){
            $userManager = new UserManager(new PDOFactory());
            $userManager->insertUser($user);

            echo json_encode(["register" => true]);
        }
        else{
            echo json_encode(["register" => false]);
        }
    }

}
