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
          $this->middleware('marchant')->only(['index']);
          
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

     


        $total_card_order=Orders::join('vaila','vaila.id','orders.vaial_id')
            ->join('payments','payments.order_id','=','orders.id')
            ->where('vaila.user_id',auth('api-jwt')->user()->id)
            ->where('payments.type','card')
            ->groupBy('orders.id')->count();;


        $total_cash_order=Orders::join('vaila','vaila.id','orders.vaial_id')
            ->join('payments','payments.order_id','=','orders.id')
            ->where('vaila.user_id',auth('api-jwt')->user()->id)
            ->where('payments.type','cash')
            ->whereNotIn('orders.id', function($q){
                $q->select('orders.id')->from('orders')
                ->join('vaila','vaila.id','orders.vaial_id')
                ->join('payments','payments.order_id','=','orders.id')
                ->where('vaila.user_id',auth('api-jwt')->user()->id)
                ->where('payments.type','card');
            })
            ->groupBy('orders.id')->count();;


        
        return response()->json([
            'success' => true,
          
           'data' => [
               'total_number_order'=>$total_number_order,
               'debit'=>$for_me ,
               'credit'=>$for_app,
               'cash'=>$cash,
               'card'=>$card,
               'total_cash_order'=>$total_cash_order,
               'total_card_order'=>$total_card_order

           ]
        ]);
    }









}
