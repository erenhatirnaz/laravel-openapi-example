<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\RequestBody(
 *      request="LoginRequest",
 *      required=true,
 *      @OA\JsonContent(
 *          required={"email", "password"},
 *          @OA\Property(property="email", type="string", description="E-mail address", example="john.doe@example.com"),
 *          @OA\Property(property="password", type="string", description="Password", example="123456"),
 *      )
 * )
 */
class LoginRequest extends FormRequest
{
    public function rules()
    {
        return [
            'email' => 'required|email',
            'password' => 'required'
        ];
    }
}
