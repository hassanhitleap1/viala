<?php

namespace App\Http\Middleware;

use Closure;
use Exception;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;

class JwtMiddleware extends BaseMiddleware
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
        $token = JWTAuth::getToken();
        try {
            if(!$token){
                return response()->json(['success'=>false,'massage' => 'Authorization Token not found' ]);
          
            }
            JWTAuth::parseToken()->authenticate();

        } catch (Exception $e) {
            if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException){
//                return response()->json(['status'=>600,'massage' => 'Token is Invalid']);
            return response()->json(['success'=>false,'massage' => 'Token is Invalid' ]);
                return response()->json(['code'=>600,'massage' => 'Token is Invalid'], 401);
            }else if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException){
                return response()->json(['success'=>false,'massage' => 'Token is Expired' ]);
                return response()->json(['code'=>601,'massage' => 'Token is Expired'], 401);
            }elseif($e instanceof  \Tymon\JWTAuth\Exceptions\TokenBlacklistedException){
                return response()->json(['success'=>false,'massage' =>  'The token has been blacklisted' ]);
                return response()->json(['code'=>500,'massage' => 'The token has been blacklisted'], 500);
            }else{
                return response()->json(['success'=>false,'massage' =>  'Authorization Token not found' ]);
                return response()->json(['code'=>602,'massage' => 'Authorization Token not found'], 401);
            }
        }
        return $next($request);
    }
}
