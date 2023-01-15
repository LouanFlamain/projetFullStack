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
    public function SendInvitation (Invitation $invitation)
    {
        if (!empty($invitation)){
            $token= JWTHelper::CreateMailToken($invitation);
            $invitation->setToken($token);


            $invitationManager = (new InvitationManager(new PDOFactory()))
                ->CreateMailInvitation($invitation);
            (new MailHelper)->MailSender($invitation);
            return $this->renderJSON([
                "envoie" => true,
                "invitation" => $invitationManager
            ]);
        } else {
            return $this->renderJSON([
                "envoie" => false
            ]);
        }

    }
}