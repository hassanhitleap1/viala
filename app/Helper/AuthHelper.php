<?php


namespace App\Helper;

use Exception;

use Tymon\JWTAuth\Facades\JWTAuth;

class AuthHelper
{

    public static  function  checkAuth(){
        $token = JWTAuth::getToken();
      
        try {
            if(!$token){
                return false;
            }
            JWTAuth::parseToken()->authenticate();
            
        } catch (Exception $e) {
           
            if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException){
                return false;
            }else if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException){
                return false;
            }elseif($e instanceof  \Tymon\JWTAuth\Exceptions\TokenBlacklistedException){
                return false;
            }else{
                return false;
            }
        }
       
        return true;
    }
    
}
