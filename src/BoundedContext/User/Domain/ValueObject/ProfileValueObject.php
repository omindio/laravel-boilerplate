<?php

namespace App\Domain\User\Domain\ValueObjects;

use App\Domain\User\Domain\Exceptions\EmptyNameException;
use App\Domain\User\Domain\Exceptions\EmptySurnameException;

class ProfileValueObject
{
    private $name;
    private $surname;

    public function __construct(string $name, string $surname)
    {
        $this->setName($name);
        $this->setSurname($surname);
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getSurname(): string
    {
        return $this->surname;
    }

    private function setName(string $name)
    {
        if (empty($name)) {
            throw new EmptyNameException();
        }
        $this->name = $name;
    }

    private function setSurname(string $surname)
    {
        if (empty($surname)) {
            throw new EmptySurnameException();
        }
        $this->surname = $surname;
    }
}
