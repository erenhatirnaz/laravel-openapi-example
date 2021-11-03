<?php

namespace App\Http\Middleware;

use App\Models\Token as Token;
use Closure;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;

class MobToken
{
    /**
     * @var Guard
     */
    protected $auth;

    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $token = $request->bearerToken();

        $dbToken = Token::where('token', $token)->first();
        $userId = $dbToken->user_id ?? null;

        if ($userId) {
            $this->auth->onceUsingId($userId);
        }

        return $next($request);
    }
}
