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
        $user_id = JWTHelper::decodeJWT($_COOKIE['token'])->id;

        $_POST['user_id'] = $user_id;

        $tenant = new Tenant($_POST);

        var_dump($tenant);

        $tenantManager = (new TenantManager(new PDOFactory()))
        ->addTenant($tenant);
    }
}