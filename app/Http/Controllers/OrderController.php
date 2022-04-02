<?php

namespace App\Http\Controllers;

use App\Models\Orders;


class OrderController extends Controller
{

    const VIEW='orders.';

    public function  index(){
        $orders=Orders::paginate(15);
        return view(self::VIEW."index",compact('orders'));
    }
}
