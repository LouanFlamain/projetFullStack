<?php

namespace App\Manager;

use App\Entity\Rental;

class RentalManager extends BaseManager
{
    public function insertRental(Rental $rental)
    {
        $query = $this->pdo->prepare("INSERT INTO Rental (amount, title, devise, description, user_id)
        VALUES (:amount, :title, :devise, :description, :user_id)");
        $query->bindValue("amount", $rental->getAmount(), \PDO::PARAM_INT);
        $query->bindValue("title", $rental->getTitle(), \PDO::PARAM_STR);
        $query->bindValue("devise", $rental->getDevise(), \PDO::PARAM_STR);
        $query->bindValue("description", $rental->getDescription(), \PDO::PARAM_STR);
        $query->bindValue("user_id", $rental->getUser_id(), \PDO::PARAM_INT);

        $query->execute();
    }

    public function updateRental(Rental $data, $id    )
    {
        $query = $this->pdo->prepare("UPDATE Rental 
        SET amount = :amount, title = :title, devise = :devise, description = :description
        WHERE id = :id");

        $query->bindValue("amount", $data->getAmount(), \PDO::PARAM_INT);
        $query->bindValue("title", $data->getTitle(), \PDO::PARAM_STR);
        $query->bindValue("devise", $data->getDevise(), \PDO::PARAM_STR);
        $query->bindValue("description", $data->getDescription(), \PDO::PARAM_STR);
        $query->bindValue("id", $id, \PDO::PARAM_INT);

        $query->execute();
    }

    public function deleteRental(int $id)
    {
        $query = $this->pdo->prepare("DELETE FROM Rental WHERE id = :id");
        $query->bindValue("id", $id, \PDO::PARAM_INT);
        $query->execute();
    }

    public function getOneRental(int $id)
    {
        $query = $this->pdo->prepare("SELECT * FROM Rental WHERE id = :id");
        $query->bindValue('id', $id, \PDO::PARAM_INT);
        $query->execute();
        $stm = $query->fetch(\PDO::FETCH_ASSOC);
        return new Rental($stm);

    }
        
    public function getById($data): null|Rental
    {
        $query = $this->pdo->prepare("SELECT * FROM Rental WHERE user_id = :id");
        $query->bindValue("id", $data, \PDO::PARAM_INT);
        $query->execute();
        $stm = $query->fetch(\PDO::FETCH_ASSOC);

        if ($stm) {
            return new Rental($stm);
        }
        return null;
    }
}