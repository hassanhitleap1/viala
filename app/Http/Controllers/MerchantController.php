<?php

namespace App\Http\Controllers;

class MerchantController extends Controller
{

    const VIEW='merchant.';

    public function  index(){
        return view(self::VIEW."index");
    }
}
