<?php

namespace App\Http\Controllers;

use App\Http\Requests\VailaRequest;
use App\Models\Vaila;
use Illuminate\Http\Request;

class VailaController extends Controller
{
    const VIEW='vaila.';

    public function  index(){
        $vailas=Vaila::paginate(15);
        return view(self::VIEW."index" , compact('vailas'));
    }


    public function store(Request $request){
        $roulas= Vaila::rules();
        $validatedData = $request->validate($roulas);
         Vaila::create($validatedData);
        return redirect('/vaila')->with('success', 'Game is successfully saved');

    }
    public function  create(){
        return view(self::VIEW."create");
    }

    public function  edit(Vaila $vaila){
        return view(self::VIEW."edit",compact('vaila'));
    }


    public function  update(Vaila $vaila,Request $request){
        $roulas= Vaila::rules();
        $validatedData = $request->validate($roulas);
        $vaila->update($validatedData);
        return redirect('/vaila')->with('success', 'Game is successfully saved');
    }

    public function destroy(Vaila $vaila)
    {
        $vaila->delete();
        return redirect('/vaila')->with('success', 'Game Data is successfully deleted');
    }
}
