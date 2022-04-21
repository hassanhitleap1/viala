<?php

namespace App\Http\Controllers\API;

use App\Helper\Media;
use App\Http\Controllers\Controller;
use App\Http\Requests\VailaRequest;
use App\Http\Resources\VailaResource;
use App\Models\ImageVaila;
use App\Models\Orders;
use App\Models\Vaila;
use Illuminate\Http\Request;

class VailaController extends Controller
{

    use Media;
    public function __construct()
    {
          $this->middleware('jwt.verify')->only(['store','update']);
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

    public function nearby (){
        return VailaResource::collection(Vaila::nearby()->limit(10)->get());
    }

    public function index(){
        return VailaResource::collection(Vaila::paginate(10));
    }

    public function store(VailaRequest $request){

        $request['number_booking']=0;
        $request['status']=0;
        $request['user_id']=auth('api-jwt')->user()->id;
        $request['number_booking']=0;
        $insert=$request->except(['images']);
      
        $next_id=Vaila::get_next_id();
     

    
        if($file = $request->file('thumb')) {
            $fileData = $this->uploads($file,"vailas/$next_id/");
            $insert['thumb'] = $fileData['filePath'] ."/".$fileData['fileName'];
          
        }
        ;
      
     
        $vaila= Vaila::create($insert);
     
        $images=[];

     
        if($files = $request->file('images') ) {
            
            foreach ($files as $file){       
               
                $fileData = $this->uploads($file,"vailas/$vaila->id/images/");
               
                $images []=[
                    'path' =>  $fileData['filePath'] ,
                    'vaila_id'=> $vaila->id
                ];

            }

            
        }
         
        if(count($images))
                ImageVaila::create($images);
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
                    'path' =>  $fileData['filePath'] ,
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
        $order =Orders::whereBetween('form_date', [$request->form_date, $request->to_date])->get();
        
        if($order->count()){
            return response()->json([
                'success'=>false,
                "message" => "this vaiual not available",
                'errors' => [],
                'status' => 422
            ], 422);
        }else{
            return response()->json([
                'success'=>true,
                "message" => "is avaialbel",
                'errors' => [],
                'status' => 422
            ], 422);
        }

    }



}
