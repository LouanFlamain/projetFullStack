<?php

namespace App\Controller;

use App\Entity\Rental;
use App\Factory\PDOFactory;
use App\Helpers\JWTHelper;
use App\Manager\RentalManager;
use App\Route\Route;

class RentalController extends AbstractController
{
    #[Route('/rental', name:'rental', methods:['POST'])]
    public function createRental()
    {

        $user_id = JWTHelper::decodeJWT($_COOKIE['token'])->id;

        var_dump($user_id);

        $_POST['user_id'] = $user_id;

        var_dump($_POST);

        $rental = new Rental($_POST);
        $rentalManager = (new RentalManager(new PDOFactory()))
        ->insertRental($rental);

        var_dump($rental);
    }

    #[Route('/rental/update/{id}', name:'updateRental', methods:['PATCH'])]
    public function updateExistingRental($id)
    {
        // @todo
        $rental = new Rental($_POST);

        $rentalManager = new RentalManager(new PDOFactory());
        $rentalUpdate = $rentalManager->getOneRental($id);

        var_dump($rental);die;

        $rentalManager->updateRental($rental, $id);
    }

    #[Route('/rental/delete/{id}', name: 'deleteRental', methods:['GET'])]
    public function deleteExistingRental($id)
    {
        $rentalManager = new RentalManager(new PDOFactory());
        $rental = $rentalManager->getOneRental($id);

        // var_dump($rentalManager);die;

        $rentalManager->deleteRental($id);
    }
}