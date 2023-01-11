<?php

namespace App\Entity;

use DateTime;

class Rental extends BaseEntity
{
    private ?int $id = null;
    private int $amount;
    private string $title;
    private string $devise;
    private string $description;
    private int $user_id;
    private ?DateTime $created_at;

    
    /**
     * Get the value of id
     * @return int
     */ 
    public function getId()
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
    public function getTitle()
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
    public function getAmount()
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
    public function getDevise()
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
    public function getDescription()
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
    public function getUser_id()
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
     * Get the value of created_at
     * @return DateTime $created_at
     */ 
    public function getCreated_at()
    {
        return $this->created_at;
    }

    /**
     * Set the value of created_at
     * @param DateTimea
     * @return  Rental
     */ 
    public function setCreated_at($created_at)
    {
        $this->created_at = $created_at;

        return $this;
    }
}