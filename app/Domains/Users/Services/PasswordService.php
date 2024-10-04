<?php

namespace App\Domains\Users\Services;

use App\Domains\Users\Exceptions\IncorrectPasswordException;
use App\Domains\Users\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Domains\Users\Repositories\UserRepositoryInterface;

class PasswordService
{
    protected $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function update(User $user, array $data)
    {
        if (!Hash::check($data['currentPassword'], $user->password)) {
            throw new IncorrectPasswordException();
        }

        $hashedPassword = Hash::make($data['password']);
        $this->userRepository->updatePassword($user, $hashedPassword);
    }
}
