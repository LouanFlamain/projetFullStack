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

    public function CreateMailInvitation(Invitation $invitation): void
    {
        try
        {

            $query = $this->pdo->prepare("INSERT INTO Invitation (token,mail, rental_id) VALUES (:token, :mail, :rental_id)");
            $query->bindValue('token', $invitation->getToken(), \PDO::PARAM_STR);
            $query->bindValue('mail', $invitation->getMail(), \PDO::PARAM_STR);
            $query->bindValue('rental_id', $invitation->getRental_id(), \PDO::PARAM_STR);
            $query->execute();

            $invitation = true;
            echo json_encode([
                "invitation" => $invitation
            ]);
        }
        catch(\PDOException $e)
        {
            if($e->getCode() == "23000")
            {
                throw new \Exception("Mail déja utilisé");
            }
            else
            {
                throw $e;
            }
        }
        
    }
}