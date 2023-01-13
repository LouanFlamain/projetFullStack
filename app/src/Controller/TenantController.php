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
    public function updateExistingTenant()
    {
        $json = file_get_contents('php://input');
        $data = (array)json_decode($json);

        $tenant = new Tenant($data);

        $tenantManager = new TenantManager(new PDOFactory());
        $tenantUpdate = $tenantManager->getById($data);

        $tenantManager->updateTenant($id);
    }
}