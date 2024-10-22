<?php

namespace App\BoundedContext\Authentication\Presentation\Request;

use App\Shared\Presentation\Request;

class PasswordResetRequest extends Request
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'email' => 'required|email',
            'captchaToken' => 'required|string'
        ];
    }
}
