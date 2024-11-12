<?php

namespace App\BoundedContext\Authorization\Presentation\Request;

use App\Shared\Presentation\Request;

class UpdateRoleRequest extends Request
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'id' => 'required|integer',
            'name' => 'required|string'
        ];
    }
}
