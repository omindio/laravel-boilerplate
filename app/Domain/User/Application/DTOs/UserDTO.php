<?php

namespace App\Domain\User\Application\DTOs;

use App\Domain\User\Domain\Abstracts\BaseUser;

class UserDTO extends BaseUser
{
    public function __construct(int $id, string $name, string $email, string $createdAt, array $roles, array $permissions)
    {
        parent::__construct($id, $name, $email, $createdAt, $roles, $permissions);
    }
}
