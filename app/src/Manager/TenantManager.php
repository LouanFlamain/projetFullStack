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
    
        return $tab;
    }

    public function insertById(Tenant $data): void
    {
        $query = $this->pdo->prepare("INSERT INTO Tenant (total_amount,user_id) VALUES (:total_amount, :user_id)");
        $query->bindValue('total_amount', $data->getRelationship()->getTotal_amount(), \PDO::PARAM_INT);
        $query->bindValue('user_id', $data->getUser_id(), \PDO::PARAM_INT);
        $query->execute();
    }

    public function addTenant(Tenant $data)
    {
        $query = $this->pdo->prepare("INSERT INTO Tenant (balance, user_id, rental_id)
         VALUES (:balance, :user_id, :rental_id)");

        $query->bindValue('balance', $data->getBalance(), \PDO::PARAM_INT);
        $query->bindValue('user_id', $data->getUser_id(), \PDO::PARAM_INT);
        $query->bindValue('rental_id', $data->getRental_id(), \PDO::PARAM_INT);

        $query->execute(); 
    }

    public function updateTenant(Tenant $data)
    {
        $query = $this->pdo->prepare("UPDATE Tenant 
        SET balance = :balance
        WHERE id = :id");

        $query->bindValue('balance', $data->getBalance(), \PDO::PARAM_INT);
        $query->bindValue('id', $data->getId(), \PDO::PARAM_INT);

        $query->execute(); 
    }

}