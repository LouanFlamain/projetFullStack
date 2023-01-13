<?php

namespace App\Entity;

use App\Factory\PDOFactory;
use App\Traits\Hydrator;
use App\Manager\UserManager;
use App\Manager\RentalManager;
use App\Manager\TenantManager;
use App\Manager\Invitation;
use App\Manager\CostManager;

abstract class BaseEntity
{
    use Hydrator;

    private object|string|null $relationship;

    public function __construct(array $data = [])
    {
        $this->hydrate($data);
    }

    /**
     * @return object|null
     */
    public function getRelationship(): ?object
    {
        return $this->relationship;
    }

    /**
     * @param object|null $relationship
     * @return $this
     */
    public function setRelationship(?object $relationship)
    {
        $this->relationship = $relationship;
        return $this;
    }

    public function hasMany($data, $foreignId)
    {
        $foreignId = 'get'.ucfirst($foreignId);
 
        $relation = (new $data(new PDOFactory()))->getById($this->$foreignId());
        $relation->relationship = $this;

        return $relation;
    }

    public function belongTo($data)
    {
        $this->relationship = (new $data(new PDOFactory()))->getById($this->getId());
        return $this;
    }

    public function save()
    {
        $obj = new $this->relationship(new PDOFactory());
        if(is_callable($obj, 'insertById')){
            $this->relationship = $obj->insertById($this->getId());
        } else {
            $this->relationship = $obj->insert($this->getId());
        }
        return $this;
    }

    public function liason()
    {
        $classNameManager = match(get_class($this)){
            User::class => UserManager::class,
            Tenant::class => TenantManager::class,
            Invitation::class => InvitationManager::class,
        };
    
    }
}