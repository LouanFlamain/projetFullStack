<?php

namespace App\Controller;

use App\Entity\Cost;
use App\Factory\PDOFactory;
use App\Manager\CostManager;
use App\Route\Route;

class CostController extends AbstractController
{
    #[Route('/costs', name:'costs', methods: ["POST"])]
    public function setCost()
    {
        $json = file_get_contents('php://input');
        $data = (array)json_decode($json);

        if(!empty($data))
        {
            $cost = (new Cost($data));

            $costManager = (new CostManager(new PDOFactory()));
            // ->getById($cost);

            var_dump($cost, "////////////////");
        
            $costManager->insertCost($cost);
        }
    }
    #[Route('/costs/delete/{id}', name:'deleteCosts', methods: ['DELETE'])]
    public function deleteExistingCost($id)
    {
        //todo add role to cookie ??
        $costManager = new CostManager(new PDOFactory());
        $cost = $costManager->getOneCost($id);
    }
}