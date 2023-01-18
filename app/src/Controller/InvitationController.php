<?php

namespace App\Controller;

use App\Entity\Invitation;
use App\Factory\PDOFactory;
use App\Helpers\MailHelper;
use App\Manager\InvitationManager;
use App\Route\Route;
use App\Helpers\JWTHelper;
use App\Manager\UserManager;

class InvitationController extends AbstractController
{
    #[Route('/invitation', name: "invitation", methods: ["POST"])]
    public function SendInvitation (Invitation $invitation)
    {
        /** @var Rental $rental */

        if (!empty($invitation)){

            $userManager = (new UserManager(new PDOFactory()))
            ->getById(($this->getUser())->id);
            
            $rental = $userManager->Rental();

            ($invitation)
            ->setRental_Id($rental->getId());


            $token = JWTHelper::CreateMailToken($invitation);

            ($invitation)
            ->setToken($token);
            
            $invitationManager = (new InvitationManager(new PDOFactory()))
                ->CreateMailInvitation($invitation);

            (new MailHelper)->MailSender($invitation);

        }
    }
}