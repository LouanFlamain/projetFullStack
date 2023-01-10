<?php

namespace App\Entity;

use App\Factory\PDOFactory;
use App\Manager\TenantManager;
use App\Traits\Hydrator;

abstract class BaseEntity
{
    use Hydrator;

    private ?object $relationship;

    public function __construct(array $data = [])
    {
        $this->hydrate($data);
    }

    public function belongTo($data)
    {
        $this->relationship = (new $data(new PDOFactory()))->getById($this->getId());
        return $this;
    }
}