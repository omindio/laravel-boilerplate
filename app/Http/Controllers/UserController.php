<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/**
 * @OA\Info(
 *     title="My API",
 *     version="1.0",
 *     description="This is the API documentation for my application.",
 *     @OA\Contact(
 *         email="contact@example.com"
 *     )
 * )
 */

class UserController extends Controller
{
    /**
     * @OA\Get(
     *     path="/users",
     *     summary="Get list of users",
     *     tags={"Users"},
     *     @OA\Response(
     *         response=200,
     *         description="List of users",
     *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/User"))
     *     )
     * )
     */
    public function index()
    {
        // Código de tu método aquí
    }
}
