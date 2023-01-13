<?php

namespace App\Controller;

use App\Entity\Cost;
use App\Factory\PDOFactory;
use App\Manager\CostManager;
use App\Route\Route;

class CostController extends AbstractController
{
    #[Route('/costs', name:'costs', methods:["POST"])]
    public function setCost($cost)
    {
        if(!empty($cost))
        {
            $costManager = (new CostManager(new PDOFactory()));
        
            $costManager->insertCost($cost);

            echo json_encode(["costs" => true]);
        }
    }

    #[Route('/costs/delete/{id}', name:'deleteCosts', methods:['DELETE'])]
    public function deleteExistingCost($id)
    {
        $costManager = new CostManager(new PDOFactory());
    }

    #[Route('/costs/update/{id}', name:'updateCosts', methods:['PATCH'])]
    public function updateExistingCost($id, $costs)
    {
        $costManager = new CostManager(new PDOFactory());

        $costManager->updateCost($costs, $id);

        echo json_encode(["update costs" => true]);
    }
}