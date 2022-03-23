<?php

namespace App\Http\Controllers;

class GovernorateController extends Controller
{
    const VIEW='governorate.';

    public function  index(){
        return view(self::VIEW."index");
    }

    public function  create(){
        return view(self::VIEW."create");
    }
}
