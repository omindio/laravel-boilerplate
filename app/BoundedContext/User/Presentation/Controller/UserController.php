<?php

namespace App\BoundedContext\User\Presentation\Controller;

use App\Shared\Presentation\Controller;

class UserController extends Controller
{
    public function index()
    {
        // Código de tu método aquí
        return response()->json(['users' => []]);
    }
}
