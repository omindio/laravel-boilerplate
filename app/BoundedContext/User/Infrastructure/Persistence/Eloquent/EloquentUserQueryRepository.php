<?php

namespace App\BoundedContext\User\Infrastructure\Persistence\Eloquent;

use App\BoundedContext\User\Application\Contract\UserDatabaseMapperInterface;
use App\BoundedContext\User\Domain\Contract\UserQueryRepositoryInterface;
use App\Shared\Infrastructure\Persistence\Eloquent\Model\UserModel;
use App\BoundedContext\User\Domain\Entity\User;
use App\Shared\Domain\ValueObject\Email;
use App\Shared\Domain\ValueObject\UserId;

class EloquentUserQueryRepository implements UserQueryRepositoryInterface
{
    private UserModel $model;
    private UserDatabaseMapperInterface $userDatabaseMapper;

    public function __construct(UserModel $userModel, UserDatabaseMapperInterface $userDatabaseMapper)
    {
        $this->model = $userModel;
        $this->userDatabaseMapper = $userDatabaseMapper;
    }

    public function findById(UserId $id): ?User
    {
        $userModel = $this->model::find($id->value());
        return $userModel ? $this->userDatabaseMapper->toEntity($userModel) : null;
    }

    public function findByEmail(Email $email): ?User
    {
        $userModel = $this->model::where('email', $email->value())->first();
        return $userModel ? $this->userDatabaseMapper->toEntity($userModel) : null;
    }
}
