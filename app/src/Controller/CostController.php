<?php

namespace App\Controller;

use App\Entity\Cost;
use App\Factory\PDOFactory;
use App\Manager\CostManager;
use App\Manager\TenantManager;
use App\Route\Route;

class CostController extends AbstractController
{
    #[Route('/costs', name:'costs', methods:["POST"])]
    public function setCost(Cost $cost)
    {
        if(!empty($cost))
        {
            $user = $this->getUser();
            $tenantRelation = $user->Tenant();
            $cost->setTenant_id($tenantRelation->getId());

            $costManager = (new CostManager(new PDOFactory()));
            $costManager->insertCost($cost);
            $balance = $tenantRelation->getBalance() + $cost->getDebit();
            $tenantRelation->setBalance($balance);
            $tenantManager = (new TenantManager(new PDOFactory()));
            $tenantManager->updateTenant($tenantRelation,$tenantRelation->getId());
            echo json_encode(["costs" => true]);
        }
    }

    #[Route('/costs', name:'costs', methods:["GET"])]
    public function getCost()
    {
        $user = $this->getUser();
        $cost = $user->Tenant()->Cost("UNPAID");
        $cost->relationship = '';
        $tab = [];
        foreach ((array)$cost as $key => $data){
            if(is_int($key)){
                $tab[$key] = [
                    'id' => $data->getId(),
                    "debit" => (string)$data->getDebit(),
                    "cost_type" => (string)$data->getCost_type(),
                    "credit" => (string)$data->getCredit(),
                    "reference" => $data->getReference(),
                    "tenant_id" => (string)$data->getTenant_id(),
                    "status" => $data->getStatus(),
                ];
            }

        }
        return json_encode($tab);die;
    }


    #[Route('/costs/delete/{id}/{reference}', name:'deleteCosts', methods:['DELETE'])]
    public function deleteExistingCost($cost, $reference, $id)
    {
        $costManager = new CostManager(new PDOFactory());
        $costManager->deleteCost($cost, $reference, $id);
    }

    #[Route('/costs/update/{id}', name:'updateCosts', methods:['PATCH'])]
    public function updateExistingCost($id)
    {
        $costManager = new CostManager(new PDOFactory());

        $cost = $costManager->getById($id);
        $cost->setStatus('PAID');

        $costManager->updateStatusCost($cost, $id);
        $costOrigin = $costManager->selectWhereReference($cost);

        $tenantManager = new TenantManager(new PDOFactory());
        $tenantEntity = ($this->getUser())->Tenant();
        $tenantEntity->setBalance($cost->getCredit() + $tenantEntity->getBalance());
        $tenantManager->updateTenant($tenantEntity, $id);

        $tenantOrigin = $tenantManager->getById($costOrigin->getTenant_id());
        $tenantEntity->setBalance($tenantOrigin->getBalance() - $cost->getCredit());

        $tenantManager->updateTenant($tenantEntity, $id);

        echo json_encode(["update costs" => true]);
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