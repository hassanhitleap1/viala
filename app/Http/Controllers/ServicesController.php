<?php

namespace App\Http\Controllers;

use App\Helper\Media;
use App\Models\Services;

use Illuminate\Http\Request;

class ServicesController extends Controller
{
    const VIEW='services.';
    use Media;

    public function __construct()
    {
        $this->middleware('auth');
    }
    public function  index(){
        $services=Services::all();
        return view(self::VIEW."index" , compact('services'));
    }


    public function store(Request $request){
        $roulas= Services::rules();
        $validatedData = $request->validate($roulas);
        $next_id=Services::get_next_id();
        if($file = $request->file('file')) {
            $fileData = $this->uploads($file,"services/$next_id/");
            $validatedData['image'] = $fileData['filePath'] ;
        }

        $model =Services::create($validatedData);    
        return redirect('/services')->with('success', 'Game is successfully saved');

    }
    public function  create(){
      
        return view(self::VIEW."create");
    }

    public function  edit(Services $service){
       
        return view(self::VIEW."edit",compact('services'));
    }

    public function show(Services $services){
        return view(self::VIEW."show",compact('services'));
    }

    public function  update(Services $services,Request $request){
        $roulas= Services::rules();

        $validatedData = $request->validate($roulas);
        $services->update($validatedData);
  
        return redirect('/servicess')->with('success', 'Game is successfully saved');
    }

    public function destroy(Services $service)
    {
        $service->delete();
        return redirect('/services')->with('success', 'Game Data is successfully deleted');
    }



   
}
