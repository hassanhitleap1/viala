<?php

namespace App\Http\Controllers;

use App\Helper\Media;
use App\Models\Slider;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    const VIEW='sliders.';
    use Media;

    public function __construct()
    {
        $this->middleware('auth');
    }
    public function  index(){
        $sliders=Slider::all();
        return view(self::VIEW."index" , compact('sliders'));
    }


    public function store(Request $request){
        $roulas= Slider::rules();
        $validatedData = $request->validate($roulas);

        $next_id=Slider::get_next_id();
        if($file = $request->file('file')) {
            $fileData = $this->uploads($file,"sliders/$next_id/");
            $validatedData['path'] = $fileData['filePath'] ;
        }

        $model =Slider::create($validatedData);    
        return redirect('/sliders')->with('success', 'Game is successfully saved');

    }
    public function  create(){
      
        return view(self::VIEW."create");
    }



    public function destroy(Slider $Slider)
    {
        $Slider->delete();

        return redirect('/sliders')->with('success', 'Game Data is successfully deleted');
    }



   
}
