<?php

namespace App\Http\Controllers;

use App\Models\Orders;
use Illuminate\Http\Request;

class OrderController extends Controller
{

    const VIEW='orders.';

    public function  index(){
        $orders=Orders::query();
        if(isset($_GET['status']) ){
            $orders->where('status',$_GET['status']);
        }
        $orders=$orders->paginate(15);
        return view(self::VIEW."index",compact('orders'));
    }

    public function  edit(Orders $order){
        
        return view(self::VIEW."edit",compact('order'));
    }

    public function  update(Orders $order,Request $request){
        $order->update($request->all());
        return redirect('orders')->with('success', 'Game is successfully saved');
    }

   
}
