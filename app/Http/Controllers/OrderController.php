<?php

namespace App\Http\Controllers;

use App\Models\Vaila;

class OrderController extends Controller
{

    const VIEW='orders.';

    public function  index(){
        $vailas=Vaila::paginate(15);
        return view(self::VIEW."index",['vailas'=>$vailas]);
    }
}
