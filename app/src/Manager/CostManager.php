<?php

namespace App\Manager;

use App\Entity\Cost;

class CostManager extends BaseManager
{
    public function getById($data)
    {
        $query = $this->pdo->prepare("SELECT * FROM Costs WHERE user_id = $data");
        $query->execute();
        $stm = $query->fetchAll(\PDO::FETCH_ASSOC);

        if (count($stm) === 1) {
            return new Cost($stm[0]);
        }

        $tab = [];
        foreach ($stm as $key => $data){
            $tab[$key] = new Cost($data);
        }

        return (object)$tab;
    }

    public function getByReference($data)
    {
        try
        {
            $query = $this->pdo->prepare("SELECT * FROM Costs
            WHERE reference = :reference");
            $query->bindValue('reference', $data, \PDO::PARAM_STR);
            $query->execute();
            
            $stm = $query->fetchAll(\PDO::FETCH_ASSOC);
    
            if (count($stm)) {
                return new Cost($stm[0]);
            }

            $tab = [];

            foreach ($stm as $key => $data)
            {
                $tab[$key] = new Cost($data);
            }
    
            return (object)$tab;
        }
        catch(\PDOException $e)
        {

        }
    }

    public function getByIdRelationship($data)
    {
        $query = $this->pdo->prepare("SELECT * FROM Costs WHERE tenant_id = $data");
        $query->execute();
        $stm = $query->fetchAll(\PDO::FETCH_ASSOC);
        if (count($stm) === 1) {
            return new Cost($stm[0]);
        }

        $tab = [];
        foreach ($stm as $key => $data){
            $tab[$key] = new Cost($data);
        }

        return (object)$tab;
    }

    public function insertById(Cost $data): void
    {
        $query = $this->pdo->prepare("INSERT INTO Costs (amount,costs_type_id) VALUES (:amount, :costs_type_id)");
        $query->bindValue('amount', $data->getAmount(), \PDO::PARAM_INT);
        $query->bindValue('user_id', $data->getCostsTypeId(), \PDO::PARAM_INT);
        $query->execute();
    }

    public function insertCost(Cost $data)
    {
        try 
        {
            $query = $this->pdo->prepare("INSERT INTO Costs (credit, debit, cost_type, reference, tenant_id)
            VALUES (:credit, :debit, :cost_type, :reference, :tenant_id)");
    
            $query->bindValue('credit', $data->getCredit(), \PDO::PARAM_INT);
            $query->bindValue('debit', $data->getDebit(), \PDO::PARAM_INT);
            $query->bindValue('cost_type', $data->getCost_type(), \PDO::PARAM_STR);
            $query->bindValue('reference', $data->getReference(), \PDO::PARAM_STR);
            $query->bindValue('tenant_id', $data->getTenant_id(), \PDO::PARAM_INT);
    
            $query->execute();
            return $cost = true;
        }
        catch(\PDOException $e)
        {
            if($e->getCode() == "23000")
            {
                $cost = false;
                $errorType = explode('key',$e->errorInfo[2])[1];
                echo json_encode([
                    "add_cost" => $cost,
                    "clef dupliquee" => $errorType         $query = $this->pdo->prepare("DELETE FROM `Costs` WHERE `reference` = :reference");
                    $query->bindValue('reference', $reference, \PDO::PARAM_STR);
                    $query->execute();
                ]);
                die;
            }
        }
    }

    public function deleteCost(Cost $reference): void
    {
        try
        {
            $cost = true;

            $query = $this->pdo->prepare("DELETE FROM `Costs` WHERE `reference` = :reference");
            $query->bindValue('reference', $reference, \PDO::PARAM_STR);
            $query->execute();
        }
        catch(\PDOException $e)
        {
            $cost = false;
            echo json_encode([
                "delete_cost" => $cost
            ])
        }
    }

    public function getOneCost(int $id, string $reference)
    {
        try
        {     
            $query = $this->pdo->prepare('SELECT * FROM Costs 
            WHERE id = :id
            AND reference = :reference');
            $query->bindValue('id', $id, \PDO::PARAM_INT);
            $query->bindValue('reference', $reference, \PDO::PARAM_STR);
            $query->execute();
    
            $data = $query->fetch(\PDO::FETCH_ASSOC);
            return $data;
        }
        catch(\PDOException $e)
        {

        }
    }

    public function updateCost(Cost $data, $id)
    {
        try
        {
            $query = $this->pdo->prepare("UPDATE Costs 
            SET credit = :credit, debit = :debit, cost_type = :cost_type, reference = :reference
            WHERE id = :id");
    
            $query->bindValue("credit", $data->getCredit(), \PDO::PARAM_INT);
            $query->bindValue("debit", $data->getDebit(), \PDO::PARAM_INT);
            $query->bindValue("cost_type", $data->getCost_type(), \PDO::PARAM_STR);
            $query->bindValue("reference", $data->getReference(), \PDO::PARAM_STR);
            $query->bindValue("id", $id, \PDO::PARAM_INT);
            
            $query->execute();
            $update = true;
        }
        catch(\PDOException $e)
        {
            $update = true;
            echo json_encode([
                "update_register" => $update
            ]);
        }
    }
}