<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Accounting;
use App\Models\Orders;
use App\Models\Paymants;

class StatisticsController extends Controller
{


    public function __construct()
    {
          $this->middleware('jwt.verify')->only(['index']);
    }

    public function index(){
        $total_number_order=Orders::join('vaila','vaila.id','orders.vaial_id')
            ->where('vaila.user_id',auth('api-jwt')->user()->id)->count();
        $for_app=Accounting::where('user_id',auth('api-jwt')->user()->id)->sum('for_app');
        $for_me=Accounting::where('user_id',auth('api-jwt')->user()->id)->sum('for_me');
        $cash=Paymants::where('type','cash')->whereIn('order_id',function($q){
            $q->select('orders.id')->from('orders')->join('vaila','vaila.id','orders.vaial_id')
            ->where('vaila.user_id',auth('api-jwt')->user()->id);
        })->sum('amount');
        $card=Paymants::where('type','card')->whereIn('order_id',function($q){
            $q->select('orders.id')->from('orders')->join('vaila','vaila.id','orders.vaial_id')
            ->where('vaila.user_id',auth('api-jwt')->user()->id);
        })->sum('amount');
        return response()->json([
            'success' => true,
          
           'data' => [
               'total_number_order'=>$total_number_order,
               'debit'=>$for_app,
               'credit'=>$for_me,
               'cash'=>$cash,
               'card'=>$card
           ]
        ]);
    }









}
