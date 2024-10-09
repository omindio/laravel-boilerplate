<?php

namespace App\BoundedContext\User\Presentation\Request;

use App\Shared\Presentation\Request;

class UpdateProfileRequest extends Request
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
        ];
    }
}
