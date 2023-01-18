<?php

namespace App\Entity;

use App\Traits\PreventEmpty;

class Invitation extends BaseEntity
{
    use PreventEmpty;

    private ?int $id;
    private string $token;
    private string $mail;
    private int $rental_id;
    private ?\DateTime $created_at;
    
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
    public function setId(?int $id): Invitation
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getToken(): string
    {
        return $this->token;
    }

    /**
     * @param string $token
     */
    public function setToken(string $token): Invitation
    {
        $this->token = $token;
        return $this;
    }

    /**
     * @return string
     */
    public function getMail(): string
    {
        return $this->mail;
    }

    /**
     * @param string $mail
     */
    public function setMail(string $mail): Invitation
    {
        $this->mail = $mail;
        return $this;
    }

    /**
     * @return string
     */
    public function getRental_Id(): string
    {
        return $this->rental_id;
    }

    /**
     * @param string $rental_id
     */
    public function setRental_Id(string $rental_id): Invitation
    {
        $this->rental_id = $rental_id;
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
     */
    public function setCreated_At(\DateTime|string|null $created_at = 'now'): Invitation
    {
        $this->created_at = new \DateTime($created_at);
        return $this;
    }
}