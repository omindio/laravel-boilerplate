<?php

namespace App\BoundedContext\User\Domain\ValueObject;

use App\BoundedContext\User\Domain\Exception\InvalidIdException;

class Id
{
    private $id;

    public function __construct(int $id)
    {
        if ($id <= 0) {
            throw new InvalidIdException();
        }
        $this->id = $id;
    }

    public function value(): int
    {
        return $this->id;
    }
}
