<?php

namespace App\Http\Controllers\API;


use App\Helper\AccountingHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\OrderRequest;
use App\Http\Resources\OrderResource;
use App\Http\Resources\OrdersResource;
use App\Models\Accounting;
use App\Models\Orders;
use App\Models\Vaila;

class OrderController extends Controller
{


    public function __construct()
    {
           $this->middleware('jwt.verify')->only(['index','store','update','show','destroy']);
    }



    public function index(){
        return OrderResource::collection(Orders::paginate(10));
    }

    public function store(OrderRequest  $request){
        $order =Orders::create([
            'form_date'=>$request->form_date,
            'to_date'=>$request->to_date,
            'price'=>$request->price,
            'payment_type'=>$request->payment_type,
            'vaial_id'=>$request->vaial_id,
            'user_id'=> auth('api-jwt')->user()->id
        ]);
        $calculation=AccountingHelper::calculation_order($request->price);

        Accounting::create([
            'for_me'=>$calculation['for_app'],
            'for_app'=>$calculation['for_app'],
            'user_id'=>auth('api-jwt')->user()->id
        ]);
        $viala=Vaila::find($request->vaial_id);
        $viala->number_booking= $viala->number_booking + 1;
        $viala->save();
        //MakeOrderEvent::dispatch($order);

        return new OrdersResource($order);
    }


    public function book_naw(OrderRequest  $request){

        $order= Orders::create([
            'form_date'=>$request->form_date,
            'to_date'=>$request->to_date,
            'phone'=>$request->phone,
            'type'=>$request->price,
            'vaial_id'=>$request->vaial_id
        ]);


        return new OrdersResource($order);

    }


    public function show(Orders $order){
        return new OrdersResource($order);
    }

    public function update(Orders $order,OrderRequest $request){

        $admin= tap($order)->update([
            'form_date'=>$request->form_date,
            'to_date'=>$request->to_date,
            'phone'=>$request->phone,
            'type'=>$request->price,
            'vaial_id'=>$request->vaial_id
        ]);

        return new OrdersResource($admin);
    }


    public function destroy(Orders $order){
        $order->delete();
        return Response('',201);
    }



}
