<?php

namespace App\BoundedContext\Authorization\Presentation\Request;

use App\Shared\Presentation\Request;

class GetAllRolesRequest extends Request
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'page' => 'integer',
            'perPage' => 'integer',
        ];
    }
}
