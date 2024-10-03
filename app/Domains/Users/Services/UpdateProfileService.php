<?php

namespace App\Domains\Users\Services;

use App\Domains\Users\Models\User;
use App\Domains\Users\Resources\UserResource;

class UpdateProfileService
{
    public function update(User $user, array $data)
    {
        $user->update($data);
    }

    public function show(User $user)
    {
        return new UserResource($user);
    }
}
