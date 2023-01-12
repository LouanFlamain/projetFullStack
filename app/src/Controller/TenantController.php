<?php

namespace App\Controller;

use App\Entity\Tenant;
use App\Factory\PDOFactory;
use App\Helpers\JWTHelper;
use App\Manager\TenantManager;
use App\Route\Route;

class TenantController extends AbstractController
{
    #[Route('/tenant', name:'tenant', methods: ['POST'])]
    public function addTenant()
    {
        $json = file_get_contents('php://input');
        $data = (array)json_decode($json);

        $user_id = JWTHelper::decodeJWT($_COOKIE['token'])->id;

        // $data['user_id'] = $user_id;
        
        $tenant = new Tenant($data);

        var_dump($tenant);

        $tenantManager = (new TenantManager(new PDOFactory()))
        ->addTenant($tenant);
    }

    #[Route('/tenant/update/{id}', name:'tenantUpdate', methods:['PATCH'])]
    public function updateExistingTenant($id)
    {
        $json = file_get_contents('php://input');
        $data = (array)json_decode($json);

        $tenant = new Tenant($data);

        $tenantManager = new TenantManager(new PDOFactory());
        $tenantUpdate = $tenantManager->getById($id);

        $tenantManager->updateTenant($tenant, $id);
    }
    #[Route('/tenant/delete/{id}', name:'tenantDelete', methods:['DELETE'])]
    public function deleteExistingTenant($id)
    {
        echo'ok';

        $tenantManager = new TenantManager(new PDOFactory());
        $tenantDelete= $tenantManager->getById($id);

        $tenantManager->deleteTenant($id);
    }
}