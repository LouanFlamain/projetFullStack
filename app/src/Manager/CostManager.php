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
        $query = $this->pdo->prepare("SELECT * FROM Costs
        WHERE reference = :reference");
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
        }
        catch(\PDOException $e)
        {
            if($e->getCode() == "23000")
            {
                $errorType = explode('key',$e->errorInfo[2])[1];
                echo json_encode([
                    "register" => false,
                    "clef dupliquee" => $errorType
                ]);
                die;
            }
        }
    }

    public function deleteCost(Cost $reference): void
    {
        $query = $this->pdo->prepare("DELETE FROM `Costs` WHERE `reference` = :reference");
        $query->bindValue('reference', $reference, \PDO::PARAM_STR);
        $query->execute();
    }

    public function getOneCost(int $id)
    {
        $query = $this->pdo->prepare('SELECT * FROM Costs WHERE id = :id');
        $query->bindValue('id', $id, \PDO::PARAM_INT);
        $query->execute();

        $data = $query->fetch(\PDO::FETCH_ASSOC);
    }

    public function updateCost(Cost $data, $id)
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
    }
   
}