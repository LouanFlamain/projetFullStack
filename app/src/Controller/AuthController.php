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
    public function login($data)
    {  
        $userManager = (new UserManager(new PDOFactory()))
        ->getByUsername($data['username']);
        
        if(password_verify($data['password'], $userManager->getHashedPassword()))
        {
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
    public function register($data): void
    {
        if (isset($data['username']) && isset($data['password']))
        {
            $user = (new User($data))->passwordHash($data['password']);
    
            if($user->getUsername() != null && $user->getHashedPassword() != null){
                $userManager = new UserManager(new PDOFactory());
                $userManager->insertUser($user);
    
                echo json_encode(["register" => true]);
                
            }
        }else {
            echo json_encode(["register" => false]);
        }
    }

}
