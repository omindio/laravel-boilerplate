<?php

namespace App\Domains\Users\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePasswordRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'currentPassword' => 'required|string',
            'password' => 'required|string|min:8|confirmed',
        ];
    }

    public function attributes()
    {
        return [
            'password' => 'password',
            'passwordConfirmation' => 'password_confirmation',
        ];
    }
}
