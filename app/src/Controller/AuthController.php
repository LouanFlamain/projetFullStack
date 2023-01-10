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
        $userManager = (new UserManager(new PDOFactory()))
            ->getById("toto");
        //var_dump($userManager->Tenant()->getRelationship());
        $test = $userManager->Tenant();
        //var_dump($_COOKIE);die;
        unset($_COOKIE['token']);
        if(!empty($_POST)) {
            $formUsername = $_POST['username'];
            $formPwd = $_POST['password'];

            $userManager = (new UserManager(new PDOFactory()))
                ->getByUsername($formUsername);

            // var_dump($userManager->passwordMatch($formPwd));die;



            return $this->renderJSON([
                'login' => 'verify',
                "token" => $jwt,
                "cookie" => json_encode($_COOKIE)
            ]);
        }
    }
    
    #[Route('/login', name: "showlogin", methods: ["GET"])]
    public function showLogin()
    {
        return $this->render("register&login/formLogin.php");

    }

    #[Route('/register', name: "showRegister", methods: ["GET"])]
    public function showRegister(): string
    {
        return $this->render("register&login/formRegister.php");
    }

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

    #[Route('/register', name: "showRegister", methods: ["GET"])]
    public function shoowRegister(): string
    {
        return $this->render("register&login/formRegister.php", [
            "trucs" => "je suis une ",
            "machin" => 42,
        ]);
    }
}
