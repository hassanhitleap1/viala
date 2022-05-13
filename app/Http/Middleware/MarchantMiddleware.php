<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Exception;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;

class MarchantMiddleware extends BaseMiddleware
{

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
       if(auth('api-jwt')->user()->type == User::CUSTOMER){
        return response()->json(['success'=>false,'massage' => 'must be owner' ]);
       }
        return $next($request);
    }
}
