<?php

namespace App\Controller;

use App\Entity\Tenant;
use App\Factory\PDOFactory;
use App\Manager\TenantManager;
use App\Route\Route;

class TenantController extends AbstractController
{
    #[Route('/tenant', name:'tenant', methods: ['POST'])]
    public function addTenant($tenant)
    {
        $tenantManager = (new TenantManager(new PDOFactory()))
        ->addTenant($tenant);
    }

    #[Route('/tenant/update/{id}', name:'tenantUpdate', methods:['PATCH'])]
    public function updateExistingTenant($id, $tenant)
    {
        $tenantManager = new TenantManager(new PDOFactory());

        $tenantManager->updateTenant($tenant, $id);
    }
    
    #[Route('/tenant/delete/{id}', name:'tenantDelete', methods:['DELETE'])]
    public function deleteExistingTenant($tenant, $id)
    {
        $tenantManager = new TenantManager(new PDOFactory());

        $tenantManager->deleteTenant($tenant, $id);
    }

    #[Route('/tenant', name:'showBalance', methods:['GET'])]
    public function showBalance($tenant)
    {
        $tenantManager = new TenantManager(new PDOFactory());
        $tenantManager->getById($tenant);
        
    }
}