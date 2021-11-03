<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

/**
 * @OA\Info(
 *      title="Laravel OpenAPI Example",
 *      version="1.0"
 * )
 *
 * @OA\Schema(
 *      schema="Error",
 *      @OA\Property(property="code", type="string", description="Error code", example="common.not-found"),
 *      @OA\Property(property="message", type="string", description="Error message", example="Resource not found."),
 * )
 * @OA\Schema(
 *      schema="Success",
 *      @OA\Property(property="code", type="string", description="Code", example="success"),
 *      @OA\Property(property="data"),
 * )
 *
 * @OA\Response(
 *      response="UnauthorizedError",
 *      description="Unauthorized",
 *      @OA\JsonContent(
 *          ref="#/components/schemas/Error",
 *          example={"code": "unauthenticated", "message": "User hasn't signed in."}
 *      )
 * )
 */
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
