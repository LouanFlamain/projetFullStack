<?php

namespace App\Controller;

use App\Entity\Tenant;
use App\Factory\PDOFactory;
use App\Manager\InvitationManager;
use App\Manager\TenantManager;
use App\Manager\UserManager;
use App\Route\Route;

class TenantController extends AbstractController
{
    #[Route('/tenant', name:'tenant', methods: ['POST'])]
    public function addTenant($tenant)
    {  
        /** @var Tenant $tenant */

        if($this->getUser()->getRole() === 'Tenant'){
            $invitationManager = (new InvitationManager(new PDOFactory()));
            $rentalId = $invitationManager->getInvitation($this->getUser())->getRental_id();
        } else {
            $rentalId = $this->getUser()->Rental()->getId();
        }
        $tenant->setRental_id($rentalId);
        $tenant->setUser_id($$this->getUser()->getId());
        
        $tenantManager = (new TenantManager(new PDOFactory()));
        $tenantResource = $tenantManager->addTenant($tenant);

        echo json_encode($tenantResource);
    }

    #[Route('/tenant/update/{id}', name:'tenantUpdate', methods:['PATCH'])]
    public function updateExistingTenant($id, $tenant)
    {
        $tenantManager = new TenantManager(new PDOFactory());

        $tenantManager->updateTenant($tenant, $id);
    }
    
    #[Route('/tenant/delete/{id}', name:'tenantDelete', methods:['DELETE'])]
    public function deleteExistingTenant($id)
    {
        $tenantManager = new TenantManager(new PDOFactory());

        $tenantManager->deleteTenant($id);
    }

    #[Route('/tenant/id', name:'showBalance', methods:['GET'])]
    public function showBalance($tenant)
    {
        $tenantManager = new TenantManager(new PDOFactory());
        $tenantManager->getById($tenant);
        
    }

    #[Route('/tenant', name:'getTenant', methods:['GET'])]
    public function showTenant()
    {
        $tenantManager = new TenantManager(new PDOFactory());
        $tenant = $tenantManager->getRentalId(($this->getUser())->Tenant());

        $tab = [];
        foreach ((array)$tenant as $key => $data){
            if(is_int($key)){
                $tab[$key] = [
                    'id' => $data->getId(),
                    "balance" => (string)$data->getBalance(),
                    "user_id" => (string)$data->getUser_id(),
                    "rental_id" => (string)$data->getRental_id(),
                    "username" => ((new UserManager(new PDOFactory()))->getById($data->getUser_id()))->getUsername(),
                ];
            }
        }
        echo json_encode($tab);die;
    }
}