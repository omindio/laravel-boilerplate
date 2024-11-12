<?php

namespace App\BoundedContext\Authorization\Presentation\Request;

use App\Shared\Presentation\Request;

class CreateRoleRequest extends Request
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|string'
        ];
    }
}
