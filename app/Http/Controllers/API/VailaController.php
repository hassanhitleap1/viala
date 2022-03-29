<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\VailaRequest;
use App\Http\Resources\VailaResource;
use App\Models\ImageVaila;
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
        return VailaResource::collection(Vaila::newArival()->paginate(10));
    }

    public function bestSell(){
        return VailaResource::collection(Vaila::bestSell()->paginate(10));
    }

    public function myViala(){
        return VailaResource::collection(Vaila::myViala()->paginate(10));
    }

    public function index(){
        return VailaResource::collection(Vaila::paginate(10));
    }

    public function store(VailaRequest $request){

        $request['number_booking']=0;
        $request['status']=0;
        $request['user_id']=auth("jwt")->user()->id;
        $request['number_booking']=0;
        $next_id=Vaila::get_next_id();

        if($file = $request->file('thumb')) {
            $fileData = $this->uploads($file,"vailas/$next_id");
            $validatedData['thumb'] = $fileData['filePath'] ."/".$fileData['fileName'];
        }
        unset($request['images']);
        $vaila= Vaila::create($request);

        $images=[];
        if($files = $request->file('images')) {
            foreach ($files as $file){
                $fileData = $this->uploads($file,"vailas/$next_id/images");
                $images []=[
                    'path' =>  $fileData['filePath'] ."/".$fileData['fileName'],
                    'vaila_id'=> $vaila->id
                ];

            }

            if(count($images))
                ImageVaila::create($images);
        }

        return new VailaResource($vaila);
    }


    public function show(Vaila $vaila){
        return new VailaResource($vaila);
    }

    public function update(Vaila $vaila,VailaRequest $request){
        $vaila= tap($vaila)->update($request->all());

        if($files = $request->file('images')) {
            foreach ($files as $file){
                $fileData = $this->uploads($file,"vailas/$vaila->id/images");
                $images []=[
                    'path' =>  $fileData['filePath'] ."/".$fileData['fileName'],
                    'vaila_id'=> $vaila->id
                ];

            }

            if(count($images)){
                ImageVaila::where('vaile_id',$vaila->id)->delete();
                ImageVaila::create($images);
            }

        }

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
