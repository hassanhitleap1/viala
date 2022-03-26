<?php

namespace App\Helper;

class StatusHelper
{
    public static function keyword_status($status){
        switch ($status) {
            case 0:
                return  "pending";
                break;
            case 1:
                return  "active";
                break;
        }
        return  "active";
    }


    public static function has_attribuate($attaribuate){

        switch ($attaribuate) {
            case 0:
                return  "yes";
                break;
            case 1:
                return  "no";
                break;

        }
        return  "no";
    }






}
