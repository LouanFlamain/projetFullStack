<?php

namespace App\Manager;

class CostManager
{
    public function getById($data)
    {
        $query = $this->pdo->prepare("SELECT * FROM Coasts WHERE user_id = $data");
        $query->execute();
        $stm = $query->fetchAll(\PDO::FETCH_ASSOC);

        if (! is_iterable($stm)) {
            return new Coasts($stm);
        }

        $tab = [];
        foreach ($stm as $key => $data){
            $tab[$key] = new Coasts($data);
        }

        return (object)$tab;
    }

    public function insertById(Coasts $data): void
    {
        $query = $this->pdo->prepare("INSERT INTO Coasts (amount,costs_type_id) VALUES (:amount, :costs_type_id)");
        $query->bindValue('amount', $data->getAmount(), \PDO::PARAM_INT);
        $query->bindValue('user_id', $data->getCostsTypeId(), \PDO::PARAM_INT);
        $query->execute();
    }
}