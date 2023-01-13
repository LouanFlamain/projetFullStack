<?php

namespace App\Controller;

use App\Entity\Cost;
use App\Factory\PDOFactory;
use App\Manager\CostManager;
use App\Route\Route;

class CostController extends AbstractController
{
    #[Route('/costs', name:'costs', methods:["POST"])]
    public function setCost($costs)
    {
        if(!empty($costs))
        {
            $costManager = (new CostManager(new PDOFactory()));
        
            $costManager->insertCost($costs);
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
    }
}