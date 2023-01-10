<?php

namespace App\Manager;

use App\Entity\User;

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

    public function getById($id)
    {
        $query = $this->pdo->prepare("SELECT * FROM User WHERE id = 1");
        // $query->bindValue("id", $user, \PDO::PARAM_INT);
        $query->execute();
        $data = $query->fetch(\PDO::FETCH_ASSOC);

        if ($data) 
        {
            return new User($data);
        }

        return null;
    }

    public function getByUsername(string $username): ?User
    {
        $query = $this->pdo->prepare('SELECT * FROM User WHERE username = :username');

        $query->bindValue(
            "username", $username, \PDO::PARAM_STR
        );

        $query->execute();

        $data = $query->fetch(\PDO::FETCH_ASSOC);

        if ($data){
            
            return new User($data);
        }

        return null;
    }

    public function insertUser(User $user)
    {
        $query = $this->pdo->prepare('INSERT INTO User (password, username, role)
                                        VALUES 
                                    (:password, :username, :role)');

        $query->bindValue(
            "password", $user->getHashedPassword(), \PDO::PARAM_STR
        );
        $query->bindValue(
            "username", $user->getUsername(), \PDO::PARAM_STR
        );
        $query->bindValue(
            "roles", $user->getRole(), \PDO::PARAM_INT
        );

        $query->execute();
    }
}