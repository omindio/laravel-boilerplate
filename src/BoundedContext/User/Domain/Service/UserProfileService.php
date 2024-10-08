<?php

namespace App\Domain\User\Domain\Services;

use App\Domain\Users\Repositories\UserRepositoryInterface;

class UserProfileService
{
    private $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function update(int $userId, UpdateProfileValueObject $updateProfileValueObject) {
        $userEntity = $this->userRepository->findById($userId);

        if (!$userEntity) {
            throw new UserNotFoundException();
        }

        $userEntity->setProfile($updateProfileValueObject);

        $this->userRepository->update($userEntity);
    }

    public function show()
    {
        //return new ProfileResource($request->user());
    }
}
