<?php

namespace App\Domains\Users\Services;

use App\Domains\Users\Models\User;

class UpdateProfileService
{
    public function update(User $user, array $data)
    {
        $user->update($data);
    }
}
