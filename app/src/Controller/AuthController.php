<?php

namespace App\Controller;

use App\Factory\PDOFactory;
use App\Helpers\JWTHelper;
use App\Manager\InvitationManager;
use App\Manager\UserManager;
use App\Route\Route;

class AuthController extends AbstractController
{
    #[Route('/login', name: "login", methods: ["POST"])]
    public function login($user)
    {  
        $userManager = (new UserManager(new PDOFactory()))
        ->getByUsername($user->getUsername());
        
        if(password_verify($user->getHashedPassword(), $userManager->getHashedPassword()))
        {
            $jwt = JWTHelper::buildJWT($userManager);

            setcookie('token', $jwt, time()+1800, '/','localhost', false, false);

            $responseData = [
                'login' => true,
                "token" => $jwt,
                "user" => [
                    'username' => $userManager->getUsername(),
                    'mail' => $userManager->getMail(),
                    'role' => $userManager->getRole(),
                ]
            ];
            echo json_encode($responseData); die;
        }
    }

    #[Route('/register', name: "register", methods: ["POST"])]
    public function register($user): void
    {
        
        if($user->getUsername() != null && $user->passwordHash($user) != null)
        {
            if($user->getToken() == null)
            {
                $user->setRole("Rental");
            }
            else
            {
                $user->setRole("Tenant");
            }

            $userManager = new UserManager(new PDOFactory());
            $userManager->insertUser($user);
            
        }
    }

    #[Route('/login/check', name:'loginCheck', methods:['POST'])]
    public function verifyJWT($user)
    {
        $cookie = $_COOKIE['token'];
        $decodedCookie = JWTHelper::decodeJWT($cookie);
    }
} 
