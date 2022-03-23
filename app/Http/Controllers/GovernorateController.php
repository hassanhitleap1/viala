<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GovernorateController extends Controller
{
    const VIEW='governorate.';

    public function  index(){
        $governorates=Governorate::paginate(15);
        return view(self::VIEW."index" , compact('governorates'));
    }


    public function store(Request $request){
        $roulas= Governorate::rules();
        $validatedData = $request->validate($roulas);
        Governorate::create($validatedData);
        return redirect('/governorate')->with('success', 'Game is successfully saved');

    }
    public function  create(){
        return view(self::VIEW."create");
    }

    public function  edit(Governorate $governorate){
        return view(self::VIEW."edit",compact('governorate'));
    }


    public function  update(Governorate $vaila,Request $request){
        $roulas= Governorate::rules();
        $validatedData = $request->validate($roulas);
        $vaila->update($validatedData);
        return redirect('/governorate')->with('success', 'Game is successfully saved');
    }

    public function destroy(Governorate $governorate)
    {
        $governorate->delete();
        return redirect('/governorate')->with('success', 'Game Data is successfully deleted');
    }
}
