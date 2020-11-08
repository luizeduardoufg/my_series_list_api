<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Exception;
use Firebase\JWT\JWT;
use Illuminate\Contracts\Auth\Factory as Auth;
use Illuminate\Support\Facades\Auth as FacadesAuth;

class Authenticate
{
    /**
     * The authentication guard factory instance.
     *
     * @var \Illuminate\Contracts\Auth\Factory
     */
    protected $auth;

    /**
     * Create a new middleware instance.
     *
     * @param  \Illuminate\Contracts\Auth\Factory  $auth
     * @return void
     */
    public function __construct(Auth $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        try {
            if (!$request->hasHeader('Authorization')) {
                throw new Exception();
            }
            $authHeader = $request->header('Authorization');
            $token = str_replace('Bearer ', '', $authHeader);
            $dadosAutenticacao = JWT::decode($token, env('JWT_KEY'), ['HS256']);

            $user = User::where('email', $dadosAutenticacao->email)->first();

            if (is_null($user)) {
                throw new Exception();
            }

            if ($request->username !== FacadesAuth::user()->username){
                throw new Exception();
            }

            // if ($this->auth->guard($guard)->guest()) {
            //     return response('Unauthorized.', 401);
            // }

            return $next($request);
        } catch (Exception $e) {
            return response()->json('Unauthorized', 401);
        }
    }
}
