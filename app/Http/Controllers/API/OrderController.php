<?php

namespace App\Http\Controllers\API;

use App\Events\MakeOrderEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\OrderRequest;
use App\Http\Resources\VailaResource;
use App\Models\Orders;

class OrderController extends Controller
{


    public function __construct()
    {
        //   $this->middleware('jwt.verify')->only(['index','store','update','show','destroy']);
    }



    public function index(){
        return OrderResource::collection(Orders::paginate(10));
    }

    public function store(OrderRequest  $request){
        $order= Orders::create([
            'form_date'=>$request->form_date,
            'to_date'=>$request->to_date,
            'phone'=>$request->phone,
            'type'=>$request->price,
            'vaial_id'=>$request->vaial_id
        ]);
        //event(new MakeOrderEvent($order));
        MakeOrderEvent::dispatch($order);

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
