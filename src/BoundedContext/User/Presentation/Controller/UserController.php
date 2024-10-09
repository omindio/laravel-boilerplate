<?php

namespace App\BoundedContext\Users\Http\Controllers;

use App\Infrastructure\Http\Controllers\Controller;

class UserController extends Controller
{
    public function index()
    {
        // Código de tu método aquí
        return response()->json(['users' => []]);
    }
}
