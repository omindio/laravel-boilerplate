<?php

namespace App\Domain\User\Domain\Repositories;

use App\Domain\User\Domain\Entities\UserEntity;

interface UserRepositoryInterface
{
    public function findById(int $id): ?UserEntity;
    public function findByEmail(string $email): ?UserEntity;
    //TODO: creo que crear el password reset token no deberia ir en el dominio de usuario, revisar
    // public function createPasswordResetToken(UserEntity $user): string;
    public function updatePassword(UserEntity $user): bool;
    public function updateProfile(UserEntity $user): bool;
}
