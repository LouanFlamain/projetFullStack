<?php

namespace App\Entity;

use App\Manager\TenantManager;
use App\Traits\PreventEmpty;
use DateTime;

class Rental extends BaseEntity
{
    use PreventEmpty;

    private ?int $id = null;
    private int $amount;
    private string $title;
    private string $devise;
    private string $description;
    private int $user_id;
    private ?DateTime $created_at;

    
    /**
     * Get the value of id
     * @return int|null
     */ 
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Set the value of id
     * @param int $id
     * @return  Rental
     */ 
    public function setId(int $id): Rental
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of title
     * @return string $title
     */ 
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * Set the value of title
     * @param string $title
     * @return  Rental
     */ 
    public function setTitle(string $title): Rental
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get the value of amount
     * @return  int $amount
     */ 
    public function getAmount(): int
    {
        return $this->amount;
    }

    /**
     * Set the value of amount
     * @param int $amount
     * @return  Tenant
     */ 
    public function setAmount(int $amount): Rental
    {
        $this->amount = $amount;

        return $this;
    }

    /**
     * Get the value of devise
     * @return string $devise
     */ 
    public function getDevise(): string
    {
        return $this->devise;
    }

    /**
     * Set the value of devise
     *
     * @return  Rental
     * @param string $devise
     */ 
    public function setDevise($devise): Rental
    {
        $this->devise = $devise;

        return $this;
    }

    /**
     * Get the value of description
     * @return string $description
     */ 
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * Set the value of description
     *
     * @return  Rental
     * @param string $description
     */ 
    public function setDescription($description): Rental
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get the value of user_id
     * @return int $user_id
     */ 
    public function getUser_id(): int
    {
        return $this->user_id;
    }

    /**
     * Set the value of user_id
     * @param int $user_id
     * @return  Rental
     */ 
    public function setUser_id($user_id): Rental
    {
        $this->user_id = $user_id;

        return $this;
    }

    /**
     * @return string
     */
    public function getCreated_At(): string
    {
        return $this->created_at->format('Y-m-d H:i:s');
    }

    /**
     * @param \DateTime|string|null $created_at
     * @return Rental
     */
    public function setCreated_At(DateTime|string|null $created_at = 'now'): Rental
    {
        $this->created_at = new \DateTime($created_at);
        return $this;
    }

    public function Tenant()
    {
        return $this->hasMany(TenantManager::class, 'user_id');
    }
}