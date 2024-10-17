<?php

namespace App\BoundedContext\User\Domain\ValueObject;

use App\Domain\ValueObject\Name;
use App\Domain\ValueObject\Surname;

class Profile
{
    private Name $name;
    private Surname $surname;

    public function __construct(Name $name, Surname $surname)
    {
        $this->name = $name;
        $this->surname = $surname;
    }

    public function getName(): Name
    {
        return $this->name;
    }

    public function getSurname(): Surname
    {
        return $this->surname;
    }
}
