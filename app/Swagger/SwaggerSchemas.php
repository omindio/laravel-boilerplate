<?php

namespace App\Swagger;

use OpenApi\Annotations as OA;
/**
 * @OA\Info(
 *     title="My API",
 *     version="1.0",
 *     description="Documentation for my API",
 *     @OA\Contact(
 *         email="contact@example.com"
 *     )
 * )
 */

/**
 * @OA\Schema(
 *     schema="User",
 *     type="object",
 *     title="User",
 *     description="User model",
 *     properties={
 *         @OA\Property(
 *             property="id",
 *             type="integer",
 *             description="User ID"
 *         ),
 *         @OA\Property(
 *             property="name",
 *             type="string",
 *             description="User name"
 *         ),
 *         @OA\Property(
 *             property="email",
 *             type="string",
 *             format="email",
 *             description="User email"
 *         )
 *     }
 * )
 */
class SwaggerSchemas
{
}