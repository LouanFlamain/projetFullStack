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
        $json = file_get_contents('php://input');
        $data = (array)json_decode($json);

        $user_id = JWTHelper::decodeJWT($_COOKIE['token'])->id;

        $data['user_id'] = $user_id;

        var_dump($data);

        $rental = new Rental($data);
        $rentalManager = (new RentalManager(new PDOFactory()))
        ->insertRental($rental);

        var_dump($rental);
    }

    #[Route('/rental/update/{id}', name:'updateRental', methods:['PATCH'])]
    public function updateExistingRental($id)
    {
        $json = file_get_contents('php://input');
        $data = (array)json_decode($json);
        
        $rental = new Rental($data);

        var_dump($rental);
        
        $rentalManager = new RentalManager(new PDOFactory());
        $rentalUpdate = $rentalManager->getOneRental($id);

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