<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Settings;

class SettingsController extends Controller
{


    public function terms_and_conditions(){

        $settings= Settings::first();
        return response()->json([$settings->terms_and_conditions]);
    }


    public function about(){

        $settings= Settings::first();
        return response()->json([$settings->about]);
    }


    public function privacy_policy(){

        $settings= Settings::first();
        return response()->json([$settings->privacy_policy]);
    }



}
