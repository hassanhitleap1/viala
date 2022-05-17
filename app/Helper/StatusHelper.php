<?php

namespace App\Helper;

class StatusHelper
{
    public static function keyword_status($status){
        switch ($status) {
            case 0:
                return  "غير نشيط";
                break;
            case 1:
                return  "نشيط";
                break;
        }
        return  "نشيط";
    }


    public static function has_attribuate($attaribuate){

        switch ($attaribuate) {
            case 0:
                return  "نعم";
                break;
            case 1:
                return  "لا";
                break;

        }
        return  "لا";
    }

    public static function gen_code(){
        $length=15;
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }





}
