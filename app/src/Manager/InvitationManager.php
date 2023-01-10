<?php

namespace App\Manager;

use App\Entity\Invitation;

class InvitationManager
{
    public function getById($data): ?Invitation
    {
        $query = $this->pdo->prepare("SELECT * FROM Invitation WHERE id = :id");
        $query->bindValue("id", $data, \PDO::PARAM_INT);
        $query->execute();
        $stm = $query->fetch(\PDO::FETCH_ASSOC);

        if ($stm) {
            return new Invitation($stm);
        }

        return null;
    }

    public function insert(Invitation $invits): void
    {

        $query = $this->pdo->prepare("INSERT INTO Invitation (token,mail) VALUES (:token, :mail)");
        $query->bindValue('token', $invits->getToken(), \PDO::PARAM_STR);
        $query->bindValue('mail', $invits->getMail(), \PDO::PARAM_STR);
        $query->execute();
    }
}