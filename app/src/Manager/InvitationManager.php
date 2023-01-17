<?php

namespace App\Manager;

use App\Entity\Invitation;

class InvitationManager extends BaseManager
{
    public function getById(int $rental_id): ?Invitation
    {
        try
        {
            $query = $this->pdo->prepare("SELECT * FROM Invitation
            WHERE rental_id = :rental_id");
            $query->bindValue("rental_id", $rental_id, \PDO::PARAM_INT);
            $query->execute();
            $stm = $query->fetch(\PDO::FETCH_ASSOC);
    
            if ($stm) {
                $payload = true;
                return new Invitation($stm);
                echo json_encode([
                    "get-mail" => $payload,
                    "token"=>$stm
                ]);
            }
        }
        catch(\PDOException $e)
        {
            $payload = false;
            echo json_encode([
                "get-mail" => $payload,
                "error" => $e
            ]); 
        }
    }

    public function getByMail(int $mail): ?Invitation
    {
        try
        {
            $query = $this->pdo->prepare("SELECT * FROM Invitation
            WHERE mail = :mail");
            $query->bindValue("mail", $mail, \PDO::PARAM_INT);
            $query->execute();
            $stm = $query->fetch(\PDO::FETCH_ASSOC);
    
            if ($stm) {
                $payload = true;
                return new Invitation($stm);
                echo json_encode([
                    "get-mail" => $payload,
                    "token"=>$stm
                ]);
            }
        }
        catch(\PDOException $e)
        {
            $payload = false;
            echo json_encode([
                "get-mail" => $payload,
                "error" => $e
            ]); 
        }
    }

    public function CreateMailInvitation(Invitation $data): void
    {
        try
        {
            $query = $this->pdo->prepare("INSERT INTO Invitation (token,mail, rental_id) VALUES (:token, :mail, :rental_id)");
            $query->bindValue('token', $data->getToken(), \PDO::PARAM_STR);
            $query->bindValue('mail', $data->getMail(), \PDO::PARAM_STR);
            $query->bindValue('rental_id', $data->getRental_id(), \PDO::PARAM_STR);
            $query->execute();

            $invitation = true;
            echo json_encode([
                "invitation" => $invitation
            ]);
        }
        catch(\PDOException $e)
        {
            echo json_encode($e);
        }
    }
}