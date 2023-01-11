<?php 

namespace App\Controller;

use App\Entity\Tenant;
use App\Manager\UserManager;
use App\Route\Route;
use App\Factory\PDOFactory;
use App\Manager\TenantManager;

class TenantController extends AbstractController
{
    #[Route('/tenant', name:'tenant', methods:['POST'])]
    public function setTenant()
    {
        $formMail = $_POST['email'];

        $tenantManager = (new TenantManager(new PDOFactory()))
                    ->getById($formMail);
        
    }
}