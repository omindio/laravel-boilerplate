<?php

namespace App\BoundedContext\User\Application\Command;

use App\BoundedContext\User\Application\Command\UpdateUserPassword;
use App\BoundedContext\User\Application\Service\UserPasswordService;
use App\BoundedContext\User\Domain\ValueObject\UpdatePassword;
use App\Shared\Domain\ValueObject\UserId;

class UpdateUserPasswordHandler
{
    private $userPasswordService;

    public function __construct(UserPasswordService $userPasswordService)
    {
        $this->userPasswordService = $userPasswordService;
    }

    public function handle(UpdateUserPassword $command): void
    {
        $updatePasswordValueObject = new UpdatePassword(
            $command->getCurrentPassword(),
            $command->getNewPassword(),
        );

        $userId = new UserId($command->getUserId());

        $this->userPasswordService->update(
            $userId,
            $updatePasswordValueObject
        );
    }
}
