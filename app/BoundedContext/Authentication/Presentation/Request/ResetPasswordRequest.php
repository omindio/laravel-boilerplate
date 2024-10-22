<?php

namespace App\BoundedContext\Authentication\Presentation\Request;

use App\Shared\Presentation\Request;

class ResetPasswordRequest extends Request
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'email' => 'required|email',
            'token' => 'required',
            'newPassword' => 'required|string|min:8',
            'confirmPassword' => 'required|string|same:newPassword',
        ];
    }
}
