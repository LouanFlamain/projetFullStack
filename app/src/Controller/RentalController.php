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
        $user_id = JWTHelper::decodeJWT($_COOKIE['token'])->id;

        $rentalManager = (new RentalManager(new PDOFactory()))
        ->insertRental($rental);

        echo json_encode(["rental" => true]);
    }

    #[Route('/rental/update/{id}', name:'updateRental', methods:['PATCH'])]
    public function updateExistingRental($id, $rental)
    {       
        $rentalManager = new RentalManager(new PDOFactory());
        $rentalUpdate = $rentalManager->getOneRental($id);

        $rentalManager->updateRental($rental, $id);
        echo json_encode(["update rental" => true]);
    }

    #[Route('/rental/delete/{id}', name: 'deleteRental', methods:['GET'])]
    public function deleteExistingRental($id)
    {
        $rentalManager = new RentalManager(new PDOFactory());
        $rental = $rentalManager->getOneRental($id);

        $rentalManager->deleteRental($id);
        echo json_encode(["delete rental" => true]);

    }
}