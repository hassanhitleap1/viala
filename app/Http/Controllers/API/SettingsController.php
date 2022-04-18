<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Settings;

class SettingsController extends Controller
{


    public function terms_and_conditions(){

        $settings= Settings::first();
        $data=[
            'body_en'=>  $settings->terms_and_conditions_en ,
            'body_ar'=>  $settings->terms_and_conditions_ar ,
            'body_he'=>  $settings->terms_and_conditions_he ,
            ];
        return response()->json( $data);
    }


    public function about(){

        $settings= Settings::first();
        $data=[
            'body_en'=>  $settings->about_en ,
            'body_ar'=>  $settings->about_ar ,
            'body_he'=>  $settings->about_he ,
            ];
        return response()->json( $data);
      
    }


    public function privacy_policy(){

        $settings= Settings::first();
        $data=[
            'body_en'=>  $settings->privacy_policy_en ,
            'body_ar'=>  $settings->privacy_policy_ar ,
            'body_he'=>  $settings->privacy_policy_he ,
            ];
        return response()->json( $data);
      
    }


    public function connectus (){

        $settings= Settings::first();
        $data=[
            'phone'=>  $settings->phone ,
            'email'=>  $settings->email ,
            ];
        return response()->json( $data);
      
    }






}
