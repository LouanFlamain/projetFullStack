<?php

namespace App\Controller;

use App\Entity\Invitation;
use App\Factory\PDOFactory;
use App\Helpers\MailHelper;
use App\Manager\InvitationManager;
use App\Route\Route;
use App\Helpers\JWTHelper;

class InvitationController extends AuthController
{
    #[Route('/invitation', name: "invitation", methods: ["POST"])]
    public function SendInvitation ()
    {
        if (!empty($_POST['mail'])){
            /** @var App\Entity\Invitation $invitation */
            $token= JWTHelper::CreateMailToken($_POST);
            $data = [
                'token'=> $token,
                'mail'=>$_POST['mail']
            ];
            $invitation= new Invitation($data);
            $invitationManager = (new InvitationManager(new PDOFactory()))
                ->CreateMailInvitation($invitation);
            (new MailHelper)->MailSender($invitation);
            return $this->renderJSON([
                "register" => true,
                "invitation" => $invitationManager
            ]);

        } else {
            return $this->renderJSON([
                "register" => false
            ]);
        }

    }
}