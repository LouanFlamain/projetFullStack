<?php

namespace App\Entity;

use DateTime;

class Tenant extends BaseEntity
{
    private ?int $id;
    private int $total_amount;
    private string $user_id;
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
    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getTotal_Amount(): int
    {
        return $this->total_amount;
    }

    /**
     * @param int $total_amount
     */
    public function setTotal_Amount(int $total_amount): void
    {
        $this->total_amount = $total_amount;
    }

    /**
     * @return string
     */
    public function getUser_Id(): string
    {
        return $this->user_id;
    }

    /**
     * @param string $user_id
     */
    public function setUser_Id(string $user_id): void
    {
        $this->user_id = $user_id;
    }

    /**
     * @return string
     */
    public function getCreated_At(): string
    {
        return $this->created_at->format('Y-m-d H:i:s');
    }

    /**
     * @param DateTime|string|null $created_at
     */
    public function setCreated_At(DateTime|string|null $created_at = 'now'): Tenant
    {
        $this->created_at = new DateTime($created_at);
        return $this;
    }
}