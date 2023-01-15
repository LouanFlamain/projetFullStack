<?php

namespace App\Controller;

use App\Factory\PDOFactory;
use App\Helpers\JWTHelper;
use App\Manager\UserManager;
use App\Route\Route;
use App\Manager\InvitationManager;
use App\Manager\RentalManager;

class AuthController extends AbstractController
{
    #[Route('/login', name: "login", methods: ["POST"])]
    public function login($user)
    {  
        $userManager = (new UserManager(new PDOFactory()))
        ->getByUsername($user->getUsername());
        $verify = false;
        
        if(password_verify($user->getHashedPassword(), $userManager->getHashedPassword()))
        {
            $verify = true;
            $jwt = JWTHelper::buildJWT($userManager);

            setcookie('token', $jwt, time()+1800, '/','localhost', false, false);
            
            $responseData = ([
                'login' => $verify,
                "token" => $jwt,
                "user" => [
                    'username' => $userManager->getUsername(),
                    'mail' => $userManager->getMail(),
                    'role' => $userManager->getRole(),
                ]
            ]);
            return $this->renderJSON($responseData);
        }
         return $this->renderJSON([
             "login" => false
        ]);
    }

    #[Route('/register', name: "register", methods: ["POST"])]
    public function register($user): void
    {
        if($user->getUsername() != null && $user->passwordHash($user) != null)
        {
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

    #[Route('/getMailToken/{rental_id}', name:'kaka', methods:['GET'])]
    public function getMailToken($invitation, $user, $rental_id, $user_id)
    {
        $mailManager = new InvitationManager(new PDOFactory());
        $jwtManager = new JWTHelper;

        $mail = $mailManager->getById($rental_id);
        $mailToken = $mail->getToken();
        $decodemail = $jwtManager->decodeMailToken($mailToken);

        echo json_encode([
            "token"=>$mail->getToken(),
            "decoded"=>$decodemail
        ]);
    }
} 
