<?php

namespace App\Entity;

use App\Interfaces\PasswordProtectedInterface;
use App\Manager\RentalManager;

class User extends BaseEntity implements PasswordProtectedInterface
{
    private ?int $id = null;
    private string $username;
    private string $password;
    private string $mail;
    private string $role;
    private string $token;

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
     * @return string 
     */
    public function getRole(): string
    {
        return $this->role;
    }

    /**
     * @param string $roles
     * @return User
     */
    public function setRole(string $roles): User
    {
        $this->role = "User";
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

    public function passwordHash(): User
    {
        $this->password = password_hash($this->password,  PASSWORD_DEFAULT );
        return $this;
    }

   public function Tenant()
   {
       return $this->hasMany(TenantManager::class, 'user_id');
   }

    public function Rental()
    {
        return $this->hasMany(RentalManager::class, 'id');
    }

    /**
     * Get the value of token
     */ 
    public function getToken()
    {
        return $this->token;
    }

    /**
     * Set the value of token
     *
     * @return  self
     */ 
    public function setToken($token)
    {
        $this->token = $token;

        return $this;
    }
}
