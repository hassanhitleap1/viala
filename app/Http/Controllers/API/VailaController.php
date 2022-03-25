<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\VailaRequest;
use App\Http\Resources\VailaResource;
use App\Models\Orders;
use App\Models\Vaila;
use Illuminate\Http\Request;

class VailaController extends Controller
{


    public function __construct()
    {
        //   $this->middleware('jwt.verify')->only(['index','store','update','show','destroy']);
    }



    public function newArival(){
        return VailaResource::collection(Vaila::paginate(10));
    }

    public function bestSell(){
        return VailaResource::collection(Vaila::paginate(10));
    }


    public function index(){
        return VailaResource::collection(Vaila::paginate(10));
    }

    public function store(VailaRequest $request){
        $admin= Vaila::create([
            'title' => $request->name,
            'desc' => $request->name,
            'new_arrivals' =>$request->name,
            'special'=>$request->name,
            'has_pool'=>$request->name,
            'has_barbikio'=>$request->name,
            'has_parcking'=>$request->name,
            'for_shbab'=>$request->name,
            'price'=>$request->name,
            'price_weekend'=>$request->name,
            'price_hoolday'=>$request->name,
            'number_room'=>$request->name,
            'number_booking'=>$request->name,

        ]);


        return new AdminResource($admin);
    }


    public function show(Vaila $vaila){
        return new VailaResource($vaila);
    }

    public function update(Vaila $vaila,VailaRequest $request){

        $vaila= tap($vaila)->update([
            'title' => $request->name,
            'desc' => $request->name,
            'new_arrivals' =>$request->name,
            'special'=>$request->name,
            'has_pool'=>$request->name,
            'has_barbikio'=>$request->name,
            'has_parcking'=>$request->name,
            'for_shbab'=>$request->name,
            'price'=>$request->name,
            'price_weekend'=>$request->name,
            'price_hoolday'=>$request->name,
            'number_room'=>$request->name,
            'number_booking'=>$request->name,
        ]);

        return new VailaResource($vaila);
    }


    public function destroy(Vaila $vaila){
        $vaila->delete();
        return Response('',201);
    }


    public function check_avialable(Request $request){
        $order =Orders::whereBetween('from', [$request->from, $request->to])->get();
        if($order->count()){
            return false;
        }
        return  true ;
    }



}
