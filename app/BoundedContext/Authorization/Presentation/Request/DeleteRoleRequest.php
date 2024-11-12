<?php

namespace App\BoundedContext\Authorization\Presentation\Request;

use App\Shared\Presentation\Request;

class DeleteRoleRequest extends Request
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'id' => 'required|integer',
        ];
    }
}
