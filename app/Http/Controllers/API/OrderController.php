<?php

namespace App\Http\Controllers\API;

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
        return OrderResource::collection(Admin::paginate(10));
    }

    public function store(OrderRequest  $request){
        $admin= Orders::create([
            'form_date'=>$request->form_date,
            'to_date'=>$request->to_date,
            'phone'=>$request->phone,
            'type'=>$request->price,
            'vaial_id'=>$request->vaial_id
        ]);

//        UserEvent::dispatch($admin);

        return new OrdersResource($admin);
    }


    public function show(Admin $admin){
        return new AdminResource($admin);
    }

    public function update(Admin $admin,AdminRequest $request){

        $admin= tap($admin)->update([
            'name'=>$request->name,
            'email'=>$request->email,
            'phone'=>$request->phone,
            // 'type'=>User::ADMIN,
            'address'=>$request->address
        ]);

        return new AdminResource($admin);
    }


    public function destroy(Admin $admin){
        $admin->delete();
        return Response('',201);
    }



}
