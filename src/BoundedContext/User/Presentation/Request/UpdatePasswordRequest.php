<?php

namespace App\BoundedContext\User\Presentation\Request;

use App\Shared\Presentation\Request;

class UpdatePasswordRequest extends Request
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'currentPassword' => 'required|string',
            'newPassword' => 'required|string|min:8|different:currentPassword',
            'confirmPassword' => 'required|string|same:newPassword',
        ];
    }
}
