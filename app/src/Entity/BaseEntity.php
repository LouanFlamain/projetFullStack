<?php

namespace App\Entity;

use App\Factory\PDOFactory;
use App\Traits\Hydrator;
use App\Manager\UserManager;
use App\Manager\TenantManager;
use App\Manager\Invitation;

abstract class BaseEntity
{
    private static $instances = array();
    use Hydrator;

    private object|string|null $relationship;

    public function __construct(array $data = [])
    {
        $this->hydrate($data);
        self::$instances[] = $this;
        //var_dump(self::$instances);
    }

    public static function getInstances()
    {
        return self::$instances;
    }

    /**
     * @return object|null
     */
    public function getRelationship(): ?object
    {
        return $this->relationship;
    }

    /**
     * @param object|string|null $relationship
     * @return $this
     */
    public function setRelationship(null|object|string $relationship)
    {
        $this->relationship = $relationship;
        return $this;
    }

    public function hasMany($data, $foreignId, $status = null)
    {
        $foreignId = 'get'.ucfirst($foreignId);
 
        $relation = (new $data(new PDOFactory()))->getByIdRelationship($this->$foreignId(), $status);
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