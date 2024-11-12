<?php

namespace App\BoundedContext\Authentication\Infrastructure\Persistence\Eloquent;

use App\BoundedContext\Authentication\Domain\Contract\UserQueryRepositoryInterface;
use App\BoundedContext\Authentication\Application\Contract\UserDatabaseMapperInterface;
use App\Shared\Infrastructure\Persistence\Eloquent\Model\UserModel;
use App\BoundedContext\Authentication\Domain\Entity\User;
use App\Shared\Domain\ValueObject\Email;
use App\Shared\Domain\ValueObject\UserId;

class EloquentUserQueryRepository implements UserQueryRepositoryInterface
{
    private UserModel $model;
    private UserDatabaseMapperInterface $mapper;

    public function __construct(UserModel $userModel, UserDatabaseMapperInterface $userDatabaseMapper)
    {
        $this->model = $userModel;
        $this->mapper = $userDatabaseMapper;
    }

    public function findById(UserId $id): ?User
    {
        $userModel = $this->model::find($id->value());
        return $userModel ? $this->mapper->toEntity($userModel) : null;
    }

    public function findByEmail(Email $email): ?User
    {
        $userModel = $this->model::where('email', $email->value())->first();
        return $userModel ? $this->mapper->toEntity($userModel) : null;
    }
}
