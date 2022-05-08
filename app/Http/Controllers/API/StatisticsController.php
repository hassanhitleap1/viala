<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Accounting;
use App\Models\Orders;


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
        return response()->json([
            'success' => true,
          
           'data' => [
               'total_number_order'=>$total_number_order,
               'for_app'=>$for_app,
               'for_me'=>$for_me
           ]
        ]);
    }









}
