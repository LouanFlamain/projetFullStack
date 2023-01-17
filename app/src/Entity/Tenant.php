<?php

namespace App\Entity;

use App\Manager\CostManager;
use App\Traits\PreventEmpty;


class Tenant extends BaseEntity
{
    use PreventEmpty;

    private ?int $id;
    private ?float $balance = null;
    private ?string $user_id = null;
    private ?string $rental_id = null;
    private ?\DateTime $created_at = null;

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
     * @return float|null
     */
    public function getBalance(): null|float
    {
        return $this->balance;
    }

    /**
     * @param float $balance
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
        $this->created_at = new \DateTime($created_at);
        return $this;
    }

    public function Cost($status = null)
    {
        return $this->hasMany(CostManager::class, 'id', $status);
    }
}