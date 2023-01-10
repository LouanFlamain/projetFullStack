<?php

namespace App\Entity;

use App\Factory\PDOFactory;
use App\Manager\TenantManager;
use App\Traits\Hydrator;

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

    public function belongTo($data)
    {
        $relation = (new $data(new PDOFactory()))->getById($this->getId());

        if($relation == new \stdClass()){
            $this->relationship = $data;
        } else {
            $this->relationship = $relation;
        }

        return $this;
    }

    public function hasMany($data)
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
}