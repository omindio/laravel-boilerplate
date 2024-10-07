<?php

namespace App\Domain\Users\Services;

use App\Domain\Users\Models\User;
use App\Domain\Users\Http\Resources\ProfileResource;
use App\Domain\Users\Repositories\UserRepositoryInterface;
use Illuminate\Http\Request;

class UserProfileService
{
    protected $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function update(User $user, array $data)
    {
        $user = $this->userRepository->updateProfile($user, $data);
        return new ProfileResource($user);
    }

    public function showByRequest(Request $request)
    {
        return new ProfileResource($request->user());
    }
}
