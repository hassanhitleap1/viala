<?php

namespace App\Http\Controllers;

class VailaController extends Controller
{
    const VIEW='vaila.';

    public function  index(){
        return view(self::VIEW."index");
    }
}
