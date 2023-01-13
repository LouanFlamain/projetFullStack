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
        $tenantUpdate = $tenantManager->getByIdToArray($this->getUser()->getId());

        foreach ($tenant as $key => $post)
        {
            $method = 'set' . ucfirst($key);
            if($post != null)
            {
                $tenant->$method($post);
                $true = true;
            }
        }
        $tenantManager = new TenantManager(new PDOFactory());

        $tenantManager->updateTenant($tenant, $id);
    }
    
    #[Route('/tenant/delete/{id}', name:'tenantDelete', methods:['DELETE'])]
    public function deleteExistingTenant($id)
    {
        $tenantManager = new TenantManager(new PDOFactory());

        $tenantManager->deleteTenant($id);
    }
}