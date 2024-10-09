<?php

namespace App\BoundedContext\User\Application\Command;

use Teamo\User\Domain\Model\User\UserRepository;

abstract class UserHandler
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }
}
