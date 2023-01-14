<?php

namespace App\Manager;

use App\Entity\Invitation;

class InvitationManager extends BaseManager
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

    public function CreateMailInvitation(Invitation $data): void
    {
        $query = $this->pdo->prepare("INSERT INTO Invitation (token,mail, rental_id) VALUES (:token, :mail, :rental_id)");
        $query->bindValue('token', $data->getToken(), \PDO::PARAM_STR);
        $query->bindValue('mail', $data->getMail(), \PDO::PARAM_STR);
        $query->bindValue('rental_id', $data->getRental_id(), \PDO::PARAM_STR);
        $query->execute();
    }
}