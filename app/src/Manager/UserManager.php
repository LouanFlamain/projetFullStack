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
//        $query->bindValue("id", $user, \PDO::PARAM_INT);
        $query->execute();
        $data = $query->fetch(\PDO::FETCH_ASSOC);

        if ($data) {
            return new User($data);
        }

        return null;
    }
}