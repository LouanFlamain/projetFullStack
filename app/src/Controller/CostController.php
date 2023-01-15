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
        }
    }

    #[Route('/costs/delete/{id}/{reference}', name:'deleteCosts', methods:['DELETE'])]
    public function deleteExistingCost($cost, $reference, $id)
    {
        $costManager = new CostManager(new PDOFactory());
        $costManager->deleteCost($cost, $reference, $id);
    }

    #[Route('/costs/update/{id}', name:'updateCosts', methods:['PATCH'])]
    public function updateExistingCost(int $id, $cost)
    {
        $costManager = new CostManager(new PDOFactory());
        $costManager->updateCost($cost, $id);
    }

    #[Route('/costs/{reference}', name:'costTest', methods:['GET'])]
    public function test($cost, string $reference)
    {
        $costManager = new CostManager(new PDOFactory());
        $costManager->getByReference($reference);
        
        foreach($cost as $costs){
            return json_encode([
                "couts" => $costs 
            ]);
        };
        return json_encode([
            "couts" => (array)$cost
        ]);
    }
}