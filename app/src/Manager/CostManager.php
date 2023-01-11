<?php

namespace App\Manager;

use App\Entity\Cost;

class CostManager extends BaseManager
{
    public function getById($data)
    {
        $query = $this->pdo->prepare("SELECT * FROM Cost WHERE user_id = $data");
        $query->execute();
        $stm = $query->fetchAll(\PDO::FETCH_ASSOC);

        if (! is_iterable($stm)) {
            return new Cost($stm);
        }

        $tab = [];
        foreach ($stm as $key => $data){
            $tab[$key] = new Cost($data);
        }

        return (object)$tab;
    }

    public function insertById(Cost $data): void
    {
        $query = $this->pdo->prepare("INSERT INTO Cost (amount,costs_type_id) VALUES (:amount, :costs_type_id)");
        $query->bindValue('amount', $data->getAmount(), \PDO::PARAM_INT);
        $query->bindValue('user_id', $data->getCostsTypeId(), \PDO::PARAM_INT);
        $query->execute();
    }

    public function deleteCost(Cost $reference): void
    {
        $query = $this->pdo->prepare("DELETE FROM `Cost` WHERE `reference` = :reference");
        $query->bindValue('reference', $reference, \PDO::PARAM_STR);
        $query->execute();
    }
}