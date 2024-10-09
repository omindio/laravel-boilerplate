<?php

namespace App\BoundedContext\User\Application\Command;

use App\BoundedContext\User\Domain\Service\UserPasswordService;
use App\BoundedContext\User\Domain\ValueObject\UpdatePassword;
use App\BoundedContext\User\Domain\ValueObject\Id;

class UpdateUserPasswordCommandHandler
{
    private $userPasswordService;

    public function __construct(UserPasswordService $userPasswordService)
    {
        $this->userPasswordService = $userPasswordService;
    }

    public function handle(UpdateUserPasswordCommand $command): void
    {
        $updatePasswordValueObject = new UpdatePassword(
            $command->getCurrentPassword(),
            $command->getNewPassword(),
        );

        $userId = new Id($command->getUserId());

        $this->userPasswordService->update(
            $userId,
            $updatePasswordValueObject
        );
    }
}
