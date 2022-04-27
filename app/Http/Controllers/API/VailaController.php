<?php

namespace App\Http\Controllers\API;

use App\Helper\Media;
use App\Http\Controllers\Controller;
use App\Http\Requests\VailaRequest;
use App\Http\Resources\VailaResource;
use App\Models\ImageVaila;
use App\Models\Orders;
use App\Models\VaialServices;
use App\Models\Vaila;
use DateTime;
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
        $insert=$request->except(['images','services']);
        $services=$request->services;
        $next_id=Vaila::get_next_id();
        if($file = $request->file('thumb')) {
            $fileData = $this->uploads($file,"vailas/$next_id/");
            $insert['thumb'] = $fileData['filePath'] ;
        }
        
      
        $vaila= Vaila::create($insert);
     
        $images=[];

     
   

        

        if($files = $request->file('images')) {
           
            foreach ($files as $key=> $file){
                $fileData = $this->uploads($file,"vailas/$vaila->id/images/$key/");
                $ImageVaila = new ImageVaila();
                $ImageVaila->path=$fileData['filePath'] ;
                $ImageVaila->vaila_id= $vaila->id;
                $ImageVaila->save();
    
            }  
        }

    

        if($services){
            $data_services=[];

            foreach($services as $key => $service){
                $mod_ser= new VaialServices();
                $mod_ser->vaila_id=$vaila->id;
                $mod_ser->services_id=$key;
                $mod_ser->save();
                
            }
        
        }
       


        return new VailaResource($vaila);
    }


    public function show(Vaila $vaila){
        return new VailaResource($vaila);
    }

    public function update(Vaila $vaila,VailaRequest $request){


       
        $services=$request->services;

        $update_data=$request->except(['images','services']);
        if($files = $request->file('images')) {
            ImageVaila::where('vaile_id',$vaila->id)->delete();
            foreach ($files as $key=> $file){
                $fileData = $this->uploads($file,"vailas/$vaila->id/images/$key/");
                $ImageVaila = new ImageVaila();
                $ImageVaila->path=$fileData['filePath'] ;
                $ImageVaila->vaila_id= $vaila->id;
                $ImageVaila->save();
    
            }  
        }


        if($services){
            

            foreach($services as $key => $service){
                $mod_ser= new VaialServices();
                $mod_ser->vaila_id=$vaila->id;
                $mod_ser->services_id=$key;
                $mod_ser->save();
                
            }
        
        }
        $vaila= tap($vaila)->update($update_data);

        return new VailaResource($vaila);
    }


    public function destroy(Vaila $vaila){
        $vaila->delete();
        return Response('',201);
    }


    public function check_avialable(Request $request){
        $order =Orders::where('vaial_id',$request->vaial_id)->whereBetween('form_date', [$request->form_date, $request->to_date])->get();
        $vaial=Vaila::find($request->vaial_id)->toArray();
        $earlier = new DateTime($request->from_date);
        $later = new DateTime($request->to_date);
        $dayes = $later->diff($earlier)->format("%a"); 
        $total_price= $vaial['price'] * $dayes; 
        $vaial['total_price']=$total_price;
        if($order->count()){
            $form_date=     date("Y-m-d", strtotime($order[0]->form_date)); 
            $to_date= date("Y-m-d", strtotime($order[0]->to_date)); 

            return response()->json([
                'success'=>false,
                "message" => "this vaial not available booked from $form_date to $to_date",
                'errors' => [],
                'status' => 422,
                'data'=>$vaial,
        
            ], 422);
        }else{
            return response()->json([
                'success'=>true,
                "message" => "is avaialbel",
                'errors' => [],
                'status' => 422,
                'data'=>$vaial,
                
            ], 422);
        }

    }



}
