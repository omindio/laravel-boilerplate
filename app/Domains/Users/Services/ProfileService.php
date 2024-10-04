<?php

namespace App\Domains\Users\Services;

use App\Domains\Users\Models\User;
use App\Domains\Users\Resources\ProfileResource;
use App\Domains\Users\Repositories\UserRepositoryInterface;
use Illuminate\Http\Request;

class ProfileService
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
