<?php

namespace App\Manager;

use App\Entity\Tenant;

class TenantManager extends BaseManager
{
    public function getById($data)
    {
        $query = $this->pdo->prepare("SELECT * FROM Tenant WHERE rental_id = $data");
        $query->execute();
        $stm = $query->fetchAll(\PDO::FETCH_ASSOC);

        if (count($stm) === 1) {
            return new Tenant($stm[0]);
        }

        $tab = [];
        foreach ($stm as $key => $data){
            $tab[$key] = (object) new Tenant($data);
        }
    
        return $tab;
    }

    public function getByIdToArray($user)
    {
        $query = $this->pdo->prepare("SELECT * FROM User WHERE id = :id");
        $query->bindValue("id", $user, \PDO::PARAM_INT);
        $query->execute();
        $data = $query->fetch(\PDO::FETCH_ASSOC);

        if ($data) {
            return $data;
        }

        return null;
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
        try 
        {
            $query = $this->pdo->prepare("INSERT INTO Tenant (balance, user_id, rental_id)
             VALUES (:balance, :user_id, :rental_id)");
    
            $query->bindValue('balance', $data->getBalance(), \PDO::PARAM_INT);
            $query->bindValue('user_id', $data->getUser_id(), \PDO::PARAM_INT);
            $query->bindValue('rental_id', $data->getRental_id(), \PDO::PARAM_INT);
            
            $query->execute(); 
            $add_tenant = true;
            echo json_encode([
                "ajout_tenanttenant"=>$add_tenant
            ]);
        }
        catch(\PDOException $e)
        {
            if($e->getCode() == "23000")
            {
                $add_tenant = false;
                $errorType = explode('key',$e->errorInfo[2])[1];
                echo json_encode([
                    "ajout_tenant" => false,
                    "clef dupliquee" => $errorType
                ]);
                die;
            }
        }
    }

    public function updateTenant(Tenant $data, $id)
    {
        try
        {
            $query = $this->pdo->prepare("UPDATE Tenant 
            SET balance = :balance
            WHERE id = :id");
    
            $query->bindValue('balance', $data->getBalance(), \PDO::PARAM_INT);
            $query->bindValue('id', $id, \PDO::PARAM_INT);
    
            $query->execute(); 

        }
        catch(\PDOException $e)
        {
            $update = false;
            echo json_encode([
                "error" => $e,
                "update" => $update
            ]);
        }
    }
    
    public function deleteTenant($tenant, $id)
    {
        try
        {
            $query = $this->pdo->prepare("DELETE FROM Tenant WHERE id = :id");
            $query->bindValue('id', $id, \PDO::PARAM_INT);
            $query->execute();

            $delete = true;
            echo json_encode([
                "delete_tenant" => $delete
            ]);
        }
        catch(\PDOException $e)
        {
            $delete = false;
            echo json_encode([
                "delete_tenant" => $delete
            ]);
        }

    }

}