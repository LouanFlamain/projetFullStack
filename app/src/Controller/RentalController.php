<?php

namespace App\Controller;

use App\Factory\PDOFactory;
use App\Helpers\JWTHelper;
use App\Manager\RentalManager;
use App\Route\Route;

class RentalController extends AbstractController
{
    #[Route('/rental', name:'rental', methods:['POST'])]
    public function createRental($rental)
    {
        if(isset($_COOKIE['token']))
        {
            $user_id = JWTHelper::decodeJWT($_COOKIE['token'])->id;
            $rental->setUser_id(($this->getUser())->getId());
            $rentalManager = (new RentalManager(new PDOFactory()))
            ->insertRental($rental);
            $rentalManager['expired'] = false;
            $this->renderJSON($rentalManager);
        }
        else
        {
            return ['expired' => true];
        }
    }

    #[Route('/rental/update/{id}', name:'updateRental', methods:['PATCH'])]
    public function updateExistingRental($id, $rental)
    {       
        $rentalManager = new RentalManager(new PDOFactory());
        $rentalManager->updateRental($rental, $id);
    }

    #[Route('/rental/delete/{id}', name: 'deleteRental', methods:['DELETE'])]
    public function deleteExistingRental(int $id)
    {
        $rentalManager = new RentalManager(new PDOFactory());

        $rentalManager->deleteRental($id);
    }
}