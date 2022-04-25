<?php

namespace App\Http\Controllers;


use App\Models\Holiday;


use Illuminate\Http\Request;

class HolidayController extends Controller
{
    const VIEW='holiday.';
    
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function  index(){
        $holidays=Holiday::all();
        return view(self::VIEW."index" , compact('holidays'));
    }


    public function store(Request $request){
        $roulas= Holiday::rules();
        $validatedData = $request->validate($roulas);
 
        $model =Holiday::create($validatedData);    
        return redirect('holiday')->with('success', 'Game is successfully saved');

    }
    public function  create(){
      
        return view(self::VIEW."create");
    }

    public function  edit(Holiday $holiday){
       
        return view(self::VIEW."edit",compact('holiday'));
    }

    public function show(Holiday $holiday){
        return view(self::VIEW."show",compact('holiday'));
    }

    public function  update($id,Request $request){
        $Holiday =Holiday::find($id);
        $roulas= Holiday::rules();
        $validatedData = $request->validate($roulas);
     
    
        $Holiday->update($validatedData);
  
        return redirect('holiday')->with('success', 'Game is successfully saved');
    }

    public function destroy(Holiday $Holiday)
    {
        $Holiday->delete();
        return redirect('holiday')->with('success', 'Game Data is successfully deleted');
    }



   
}
