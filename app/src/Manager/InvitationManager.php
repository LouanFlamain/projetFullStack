<?php

namespace App\Manager;

use App\Entity\Invitation;
use App\Entity\User;

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
                return new Invitation($stm);
                echo json_encode([
                    "get-mail" => true,
                    "token"=>$stm
                ]);
            }
        }
        catch(\PDOException $e)
        {
            return ["get-mail" => false];
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
                return new Invitation($stm);
                echo json_encode([
                    "get-mail" => true,
                    "token"=>$stm
                ]);
            }
        }
        catch(\PDOException $e)
        {
            return ["get-mail" => false];
        }
    }

    public function CreateMailInvitation(Invitation $invitation)
    {
        try
        {
            foreach($invitation->getMail() as $key => $mail){
                $token = $invitation->getToken();
                $query = $this->pdo->prepare("INSERT INTO Invitation (token,mail, rental_id) VALUES (:token, :mail, :rental_id)");
                $query->bindValue('token', $token[$key], \PDO::PARAM_STR);
                $query->bindValue('mail', $mail, \PDO::PARAM_STR);
                $query->bindValue('rental_id', $invitation->getRental_id(), \PDO::PARAM_STR);
                $query->execute();

            }
            
            return ["invitation" => true];
        }
        catch(\PDOException $e)
        {
            return ["invitation" => false];
        }
    }

    public function getInvitation(User $user)
    {
        try
        {
            $query = $this->pdo->prepare("SELECT * FROM Invitation WHERE mail = :mail");
            $query->bindValue("mail", $user->getMail(), \PDO::PARAM_INT);
            $query->execute();
            $data = $query->fetch(\PDO::FETCH_ASSOC);

            return new Invitation($data);
        }
        catch(\PDOException $e)
        {
            return ["update" => false];
        
        }
    }
}