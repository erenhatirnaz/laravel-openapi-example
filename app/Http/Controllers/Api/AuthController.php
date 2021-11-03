<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * User Login
     *
     *  @OA\Post(
     *      path="/api/auth/login",
     *      tags={"Auth"},
     *      @OA\RequestBody(ref="#/components/requestBodies/LoginRequest"),
     *      @OA\Response(
     *          response=400,
     *          description="Bad request",
     *          @OA\JsonContent(
     *              ref="#/components/schemas/Error",
     *              example={"code": "auth.incorrect", "message": "Incorrect information."},
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="OK",
     *          @OA\JsonContent(
     *              allOf={@OA\Schema(ref="#/components/schemas/Success")},
     *              @OA\Property(
     *                  property="data",
     *                  type="object",
     *                  @OA\Property(property="token", type="string", format="uuid", example="Authorization token", example="71c943d9-944f-4584-a523-2592064ae282"),
     *              )
     *          )
     *      )
     * )
     */
    public function login(LoginRequest $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');

        $user = User::query()->where('email', $email)->first();
        if (!$user) {
            return response()->json([
                'code' => "auth.incorrect",
                'message' => "Incorrect information.",
            ], 400);
        }

        if (!Auth::attempt(['email' => $email, 'password' => $password])) {
            return response()->json([
                'code' => "auth.incorrect",
                'message' => "Incorrect information.",
            ], 400);
        }

        return response()->json([
            'code' => 'success',
            'data' => [
                'token' => $user->login()["token"],
            ],
        ]);
    }
}
