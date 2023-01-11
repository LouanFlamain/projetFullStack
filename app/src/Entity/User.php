<?php

namespace App\Entity;

use App\Interfaces\PasswordProtectedInterface;
use App\Manager\TenantManager;

class User extends BaseEntity implements PasswordProtectedInterface
{
    private ?int $id = null;
    private string $username;
    private string $password;
    private string $mail;
    private int $role;

    /**
     * @return int 
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return User
     */
    public function setId(int $id): User
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * @param string $username
     * @return User
     */
    public function setUsername(string $username): User
    {
        $this->username = $username;
        return $this;
    }

    /**
     * @param string $mail
     * @return User
     */
    public function setMail(string $mail): User
    {
        $this->mail = $mail;
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
     * @return int 
     */
    public function getRole(): int
    {
        return $this->role;
    }

    /**
     * @param int $roles
     * @return User
     */
    public function setRole(int $roles): User
    {
        $this->role = $roles;
        return $this;
    }


    public function getHashedPassword(): string
    {
        return $this->password;
    }

    public function passwordMatch(string $plainPwd): bool
    {
        return true;
    }

    public function setPassword(string $password): User
    {
        $this->password = $password;

        return $this;
    }

    public function Tenant()
    {
        return $this->belongTo(TenantManager::class);
    }
}
