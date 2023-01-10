<?php

namespace App\Manager;

use App\Entity\Tenant;

class TenantManager extends BaseManager
{
    public function getById($data): ?Tenant
    {
        $query = $this->pdo->prepare("SELECT * FROM Tenant WHERE id = 1");
        $query->execute();
        $stm = $query->fetch(\PDO::FETCH_ASSOC);

        if ($stm) {
            return new Tenant($stm);
        }

        return null;
    }
}