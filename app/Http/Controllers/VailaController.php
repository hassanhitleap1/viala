<?php

namespace App\Http\Controllers;

use App\Helper\Media;
use App\Models\Governorate;
use App\Models\ImageVaila;
use App\Models\Services;
use App\Models\VaialServices;
use App\Models\Vaila;
use Illuminate\Http\Request;

class VailaController extends Controller
{
    const VIEW='vaila.';
    use  Media;

    public function __construct()
    {
        $this->middleware('auth');
    }
    public function  index(){
        $vailas=Vaila::paginate(15);
        return view(self::VIEW."index" , compact('vailas'));
    }


    public function store(Request $request){
        $roulas= Vaila::rules()["create"];;
        $services=$request->services;
        
     
       $validatedData = $request->validate($roulas);
        $validatedData['number_booking']=0;
        $validatedData['status']=0;
        $validatedData['user_id']=auth()->user()->id;
        $validatedData['number_booking']=0;
        $next_id=Vaila::get_next_id();

        if($file = $request->file('thumb')) {
            $fileData = $this->uploads($file,"vailas/$next_id/");

            $validatedData['thumb'] = $fileData['filePath'] ;
        }
        unset($validatedData['images']);
        $model =Vaila::create($validatedData);


        if($files = $request->file('images')) {
           
            foreach ($files as $key=> $file){
                $fileData = $this->uploads($file,"vailas/$model->id/images/$key/");
                $ImageVaila = new ImageVaila();
                $ImageVaila->path=$fileData['filePath'] ;
                $ImageVaila->vaila_id= $model->id;
                $ImageVaila->save();
    
            }  
        }

    

        if($services){
            $data_services=[];

            foreach($services as $key => $service){
                $mod_ser= new VaialServices();
                $mod_ser->vaila_id=$model->id;
                $mod_ser->services_id=$key;
                $mod_ser->save();
                
            }
        
        }
       

        return redirect('/vaila')->with('success', 'Game is successfully saved');

    }
    public function  create(){
        $services=Services::all();
        $governorates=Governorate::all();
        return view(self::VIEW."create",compact('governorates','services'));
    }

    public function  edit(Vaila $vaila){
        $services=Services::all();
        $selected_services=VaialServices::where('vaila_id',$vaila->id)->get()->pluck('services_id')->toArray();;
        $governorates=Governorate::all();
     
    
        return view(self::VIEW."edit",compact('vaila','governorates','services','selected_services'));
    }

    public function show(Vaila $vaila){
        return view(self::VIEW."show",compact('vaila'));
    }

    public function  update($id,Request $request){
        $vaila = Vaila::find($id);
        $roulas= Vaila::rules()["update"];

        $services=$request->services;
     
        $validatedData = $request->validate($roulas);

        unset($validatedData['services']);
        if($files = $request->file('images')) {
            ImageVaila::where('vaila_id',$vaila->id)->delete();
            foreach ($files as $key=> $file){
                $fileData = $this->uploads($file,"vailas/$vaila->id/images/$key/");
                $ImageVaila = new ImageVaila();
                $ImageVaila->path=$fileData['filePath'] ;
                $ImageVaila->vaila_id= $vaila->id;
                $ImageVaila->save();

            }           
            unset($validatedData['images']);
    

           
        }

        $vaila->update($validatedData);
        if($services){
            $data_services=[];
         
            VaialServices::where('vaila_id',$vaila->id)->delete();
            foreach($services as $key => $service){
                
                $mod_ser= new VaialServices();
                $mod_ser->vaila_id = $vaila->id;
                $mod_ser->services_id = $key;
                $mod_ser->save();
                
            }
            
           
        }


        return redirect('vaila')->with('success', 'Game is successfully saved');
    }

    public function destroy(Vaila $vaila)
    {
        $vaila->delete();
        return redirect('/vaila')->with('success', 'Game Data is successfully deleted');
    }

    public function active(Vaila $vaila)
    {
        $vaila->update(["active"=>1]);
        return redirect('/vaila')->with('success', 'Game Data is successfully ');
    }

    public function disactive(Vaila $vaila)
    {
        $vaila->update(["active"=>0]);
        return redirect('/vaila')->with('success', 'Game Data is successfully ');
    }

}
