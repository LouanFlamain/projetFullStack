<?php

namespace App\Manager;

use App\Entity\User;

class UserManager extends BaseManager
{
    /**
     * @return User[]
     */
    public function getAllUsers(): array
    {
        $query = $this->pdo->query('SELECT * FROM User');

        $users = [];

        while ($data = $query->fetch(\PDO::FETCH_ASSOC)){

            $users[] = new User($data);
        }

        return $users;
    }

    /**
     * @return User|null
     */
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
        $query = $this->pdo->prepare('INSERT INTO User (password, username, roles)
                                        VALUES 
                                    (:password, :username, :roles)');

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

    public function updateUser($roles)
    {
        $query = $this->pdo->prepare('UPDATE `User` SET `roles`= `:roles` WHERE `username`= ?');

        $query->bindValue(
            "roles", $roles, \PDO::PARAM_INT
        );
        
        $query->execute();
    }
}