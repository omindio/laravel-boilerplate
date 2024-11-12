<?php

namespace App\BoundedContext\Authorization\Domain\Entity;

use App\BoundedContext\Authorization\Domain\ValueObject\RoleName;
use App\Shared\Domain\Exception\IdAlreadySetException;
use App\Shared\Domain\ValueObject\Id;

class Role
{
    private ?Id $id;
    private RoleName $name;

    public function __construct(RoleName $name, ?Id $id = null)
    {
        $this->id = $id;
        $this->name = $name;
    }

    public function getId(): Id
    {
        return $this->id;
    }

    public function getName(): RoleName
    {
        return $this->name;
    }

    public function setId(Id $id): void
    {
        if ($this->id !== null) {
            throw new IdAlreadySetException();
        }
        $this->id = $id;
    }

    public function setName(RoleName $name): void
    {
        $this->name = $name;
    }
}
