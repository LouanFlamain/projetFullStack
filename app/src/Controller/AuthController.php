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
        $verify = false;

        $json = file_get_contents('php://input');
        $data = (array)json_decode($json);

        $userManager = (new UserManager(new PDOFactory()))
        ->getByUsername($data['username']);
        
        // $userManager->getHashedPassword();
        // var_dump($userManager->getHashedPassword());
        if(password_verify($data['password'], $userManager->getHashedPassword()))
        {
            $verify = true;

            $jwt = JWTHelper::buildJWT($userManager);
            $decoded = JWTHelper::decodeJWT($jwt);

            setcookie('token', $jwt, time()+1800, '/','localhost', false, false);

            $responseData = ([
                'login' => 'verify',
                "token" => $jwt,
                "decoded" => $decoded,
                "user" => [
                    'username' => $userManager->getUsername(),
                    'mail' => $userManager->getMail(),
                    'role' => $userManager->getRole(),
                    'password' => $userManager->getHashedPassword()
                ]
            ]);

            $responseJson = json_encode($responseData);
            echo $responseJson;
        }
    
    }
    

    #[Route('/register', name: "register", methods: ["POST"])]
    public function register(): void
    {
        $json = file_get_contents('php://input');
        $data = (array)json_decode($json);

        $user = (new User($data))->passwordHash($data['password']);

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
