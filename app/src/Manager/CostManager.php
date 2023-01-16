<?php

namespace App\Manager;

use App\Entity\Cost;

class CostManager extends BaseManager
{
    public function getById($data)
    {
        $query = $this->pdo->prepare("SELECT * FROM Costs WHERE id = $data");
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
        $query = $this->pdo->prepare("SELECT * FROM Costs WHERE reference = :reference and credit = :credit");
        $query->bindValue('reference', $data->getReference(), \PDO::PARAM_STR);
        $query->bindValue('credit', 0, \PDO::PARAM_INT);
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

    public function getByIdRelationship($data,?string $status)
    {
        if(isset($status)){
            $sql = "SELECT * FROM Costs WHERE tenant_id = $data and status = 'UNPAID'";
        } else {
            $sql = "SELECT * FROM Costs WHERE tenant_id = $data";
        }
        $query = $this->pdo->prepare($sql);
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
        $query = $this->pdo->prepare("INSERT INTO Costs (debit, credit, cost_type, reference, tenant_id) VALUES (:debit,:credit, :cost_type,:reference, :tenant_id)");
        $query->bindValue('debit', $data->getDebit(), \PDO::PARAM_INT);
        $query->bindValue('credit', $data->getCredit(), \PDO::PARAM_INT);
        $query->bindValue('cost_type', $data->getCost_Type(), \PDO::PARAM_STR);
        $query->bindValue('reference', $data->getReference(),\PDO::PARAM_STR);
        $query->bindValue('tenant_id', $data->getTenant_id(),PDO::PARAM_INT);
        $query->execute();
    }

    public function insertCost(Cost $data)
    {
        try 
        {
            $count = count($data->getRelationships())+ 1;
            $price = (($data->getDebit() * 100) / $count) * $count;
            $unique = uniqid();
            $query = $this->pdo->prepare("INSERT INTO Costs (credit, debit, cost_type, reference, tenant_id, status)
            VALUES (:credit, :debit, :cost_type, :reference, :tenant_id, :status)");
    
            $query->bindValue('credit', $data->getCredit(), \PDO::PARAM_STR);
            $query->bindValue('debit', $price, \PDO::PARAM_INT);
            $query->bindValue('cost_type', $data->getCost_type(), \PDO::PARAM_STR);
            $query->bindValue('reference', $unique, \PDO::PARAM_STR);
            $query->bindValue('tenant_id', $data->getTenant_id(), \PDO::PARAM_INT);
            $query->bindValue('status', "UNPAID", \PDO::PARAM_STR);
    
            $query->execute();

            foreach ($data->getRelationships() as $tenant){
                $query = $this->pdo->prepare("INSERT INTO Costs (credit, debit, cost_type, reference, tenant_id, status)
            VALUES (:credit, :debit, :cost_type, :reference, :tenant_id, :status)");

                $query->bindValue('credit', $price / $count, \PDO::PARAM_STR);
                $query->bindValue('debit', 0, \PDO::PARAM_INT);
                $query->bindValue('cost_type', $data->getCost_type(), \PDO::PARAM_STR);
                $query->bindValue('reference', $unique, \PDO::PARAM_STR);
                $query->bindValue('tenant_id', $tenant->tenant_id, \PDO::PARAM_INT);
                $query->bindValue('status', "UNPAID", \PDO::PARAM_STR);

                $query->execute();
            }

        }
        catch(\PDOException $e)
        {
            if($e->getCode() == "23000")
            {
                $cost = false;
                $errorType = explode('key',$e->errorInfo[2])[1];
                echo json_encode([
                    "add_cost" => $cost,
                    "clef dupliquee" => $errorType
                ]);
                die;
            }
        }
    }

    public function deleteCost($cost, $reference, $id)
    {
        try
        {
            $query = $this->pdo->prepare("DELETE FROM `Costs` 
            WHERE `reference` = :reference
            AND `id` = :id");

            $query->bindValue('reference', $reference, \PDO::PARAM_STR);
            $query->bindValue('id', $id, \PDO::PARAM_INT);

            $query->execute();

            $delete = true;
            echo json_encode([
                "delete"=>$delete
            ]);
        }
        catch(\PDOException $e)
        {
            $cost = false;
            echo json_encode([
                "delete_cost" => $cost
            ]);
        }
    }

    public function getOneCost(int $id, string $reference)
    {
        try
        {     
            $query = $this->pdo->prepare('SELECT * FROM `Costs` 
            WHERE id = :id
            AND reference = :reference');
            $query->bindValue('id', $id, \PDO::PARAM_INT);
            $query->bindValue('reference', $reference, \PDO::PARAM_STR);
            $query->execute();
    
            $data = $query->fetch(\PDO::FETCH_ASSOC);
            return new Cost($data);
        }
        catch(\PDOException $e)
        {
            echo json_encode([
                "error" => $$e
            ]);
        }
    }

    public function updateCost(Cost $data, $id)
    {
        try
        {
            $query = $this->pdo->prepare("UPDATE `Costs` 
            SET credit = :credit, debit = :debit, cost_type = :cost_type
            WHERE id = :id");
    
            $query->bindValue("credit", $data->getCredit(), \PDO::PARAM_INT);
            $query->bindValue("debit", $data->getDebit(), \PDO::PARAM_INT);
            $query->bindValue("cost_type", $data->getCost_type(), \PDO::PARAM_STR);
            $query->bindValue("id", $id, \PDO::PARAM_INT);
            
            $query->execute();
            $update = true;
            echo json_encode([
                "update_cost"=>$update
            ]);
        }
        catch(\PDOException $e)
        {
            $update = false;
            echo json_encode([
                "update_cost" => $update,
                "erreur"=>$e
            ]);
        }
    }

    public function updateStatusCost(Cost $data, $id)
    {
        $query = $this->pdo->prepare("UPDATE Costs SET status = :status WHERE id = :id");

        $query->bindValue("status", $data->getStatus(), \PDO::PARAM_STR);

        $query->bindValue("id", $id, \PDO::PARAM_INT);

        $query->execute();
    }

    public function selectWhereReference(Cost $data)
    {
        $query = $this->pdo->prepare("SELECT * FROM Costs WHERE reference = :reference and credit = :credit");

        $query->bindValue("reference", $data->getReference(), \PDO::PARAM_STR);
        $query->bindValue("credit", 0, \PDO::PARAM_INT);
        $query->execute();

        $stm = $query->fetch(\PDO::FETCH_ASSOC);
        return new Cost($stm);
    }
   
}