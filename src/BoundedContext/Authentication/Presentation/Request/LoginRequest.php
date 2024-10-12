<?php

namespace App\BoundedContext\Authentication\Presentation\Request;

use App\Shared\Presentation\Request;

class LoginRequest extends Request
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'email' => 'required|string|email',
            'password' => 'required|string'
        ];
    }
}
