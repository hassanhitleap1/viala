<?php

namespace App\Http\Controllers;

class CustomersController extends  Controller
{

    const VIEW='customers.';

    public function  index(){
        return view(self::VIEW."index");
    }

}
