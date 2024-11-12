<?php

namespace App\BoundedContext\Authorization\Infrastructure\Provider;

use App\BoundedContext\Authorization\Application\Contract\RoleDatabaseMapperInterface;
use App\BoundedContext\Authorization\Domain\Contract\RoleCommandRepositoryInterface;
use App\BoundedContext\Authorization\Domain\Contract\RoleQueryRepositoryInterface;
use App\BoundedContext\Authorization\Infrastructure\Persistence\Eloquent\EloquentRoleQueryRepository;
use App\BoundedContext\Authorization\Infrastructure\Persistence\Eloquent\Mapper\EloquentRoleDatabaseMapper;
use Illuminate\Support\ServiceProvider;

use App\BoundedContext\User\Application\Contract\UserDatabaseMapperInterface;
use App\BoundedContext\User\Infrastructure\Persistence\Eloquent\EloquentUserCommandRepository;
use App\BoundedContext\User\Infrastructure\Persistence\Eloquent\EloquentUserQueryRepository;
use App\BoundedContext\User\Infrastructure\Persistence\Eloquent\Mapper\EloquentUserDatabaseMapper;
use App\BoundedContext\User\Domain\Contract\UserCommandRepositoryInterface;
use App\BoundedContext\User\Domain\Contract\UserQueryRepositoryInterface;
use App\BoundedContext\User\Infrastructure\Persistence\Eloquent\EloquentRoleCommandRepository;

class AuthorizationServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(RoleCommandRepositoryInterface::class, EloquentRoleCommandRepository::class);
        $this->app->bind(RoleQueryRepositoryInterface::class, EloquentRoleQueryRepository::class);
        $this->app->bind(RoleDatabaseMapperInterface::class, EloquentRoleDatabaseMapper::class);
        //$this->app->bind(UserCommandRepositoryInterface::class, EloquentUserCommandRepository::class);
        //$this->app->bind(UserQueryRepositoryInterface::class, EloquentUserQueryRepository::class);
        //$this->app->bind(UserDatabaseMapperInterface::class, EloquentUserDatabaseMapper::class);
    }

    public function boot(): void {}
}
