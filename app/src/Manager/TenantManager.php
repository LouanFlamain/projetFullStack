<?php

namespace App\Manager;

use App\Entity\Tenant;

class TenantManager extends BaseManager
{
    public function getById($data)
    {
        $query = $this->pdo->prepare("SELECT * FROM Tenant WHERE user_id = $data");
        $query->execute();
        $stm = $query->fetchAll(\PDO::FETCH_ASSOC);

        if (! is_iterable($stm)) {
            return new Tenant($stm);
        }

        $tab = [];
        foreach ($stm as $key => $data){
            $tab[$key] = new Tenant($data);
        }
    
        return (object)$tab;
    }

    public function insertById(Tenant $data): void
    {
        $query = $this->pdo->prepare("INSERT INTO Tenant (total_amount,user_id) VALUES (:total_amount, :user_id)");
        $query->bindValue('total_amount', $data->getRelationship()->getTotal_amount(), \PDO::PARAM_INT);
        $query->bindValue('user_id', $data->getUser_id(), \PDO::PARAM_INT);
        $query->execute();
    }
}