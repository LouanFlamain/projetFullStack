<?php

namespace App\Manager;

use App\Entity\User;
use Exception;

class UserManager extends BaseManager
{
    public function getAllUsers(): array
    {
        $query = $this->pdo->prepare("SELECT * FROM User");
        $query->execute();
        $users = [];

        while ($data = $query->fetch(\PDO::FETCH_ASSOC)) {
            $users[] = new User($data);
        }

        return $users;
    }

    public function getByUsername($user): ?User
    {
        $query = $this->pdo->prepare("SELECT * FROM User WHERE username = :username");
        $query->bindValue("username", $user, \PDO::PARAM_STR);
        $query->execute();
        $data = $query->fetch(\PDO::FETCH_ASSOC);

        if ($data) {
            return new User($data);
        }

        return null;
    }

    public function getById($id)
    {
        $query = $this->pdo->prepare("SELECT * FROM User WHERE id = :id");
        $query->bindValue("id", $id, \PDO::PARAM_INT);
        $query->execute();
        $data = $query->fetch(\PDO::FETCH_ASSOC);

        if ($data) 
        {
            return new User($data);
        }

        return null;
    }
    public function insertUser(User $user)
    {
        try
        {
            $query = $this->pdo->prepare("INSERT INTO User (username, password, mail, role) VALUES (:username, :password, :mail, :role)");
            $query->bindValue("username", $user->getUsername(), \PDO::PARAM_STR);
            $query->bindValue("password", $user->getHashedPassword(), \PDO::PARAM_STR);
            $query->bindValue("mail", $user->getMail(), \PDO::PARAM_STR);
            $query->bindValue("role", $user->getRole(), \PDO::PARAM_STR);
    
            $query->execute();
            echo json_encode([
                "register"=> true
            ]);
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

    public function updateUser(User $data, $user_id)
    {
        try
        {
            $query = $this->pdo->prepare("UPDATE `User`
            SET role = :role 
            WHERE user_id = :user_id");
            $query->bindValue("role", $data->getRole(), \PDO::PARAM_STR);
            $query->bindValue("id", $user_id, \PDO::PARAM_INT);

            $update = true;
        }
        catch(\PDOException $e)
        {
            $update = false;
            echo json_encode([
                "update"=>$update,
                "erreur"=>$e
            ]);
        }
    }

}



