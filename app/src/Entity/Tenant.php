<?php

namespace App\Entity;

use DateTime;

class Tenant extends BaseEntity
{
    private ?int $id;
    private int $balance;
    private string $user_id;
    private string $rental_id;
    private ?DateTime $created_at;
    
    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int|null $id
     */
    public function setId(?int $id): Tenant
    {
        $this->id = $id;
        return $this;
    }
    
    /**
     * @return int
     */
    public function getBalance()
    {
        return $this->balance;
    }

    /**
     * @param int $balance
     */
    public function setBalance($balance)
    {
        $this->balance = $balance;
    }

    /**
     * @return string
     */
    public function getRental_id()
    {
        return $this->rental_id;
    }

    /**
     * @param string $rental_id
     */
    public function setRental_id($rental_id)
    {
        $this->rental_id = $rental_id;
    }
    
    /**
     * @return string
     */
    public function getUser_id(): string
    {
        return $this->user_id;
    }

    /**
     * @param string $user_id
     */
    public function setUser_id(string $user_id): Tenant
    {
        $this->user_id = $user_id;
        return $this;
    }

    /**
     * @return string
     */
    public function getCreated_at(): string
    {
        return $this->created_at->format('Y-m-d H:i:s');
    }

    /**
     * @param DateTime|string|null $created_at
     * @return Tenant
     * @throws \Exception
     */
    public function setCreated_at(DateTime|string|null $created_at = 'now'): Tenant
    {
        $this->created_at = new DateTime($created_at);
        return $this;
    }

    public function Cost()
    {
        return $this->hasMany(CostManager::class);
    }
}