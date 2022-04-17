<?php

namespace App\Http\Controllers;

use App\Helper\Media;
use App\Models\Governorate;
use Illuminate\Http\Request;

class GovernorateController extends Controller
{
    const VIEW='governorate.';
    use Media;
    public function  index(){
        $governorates=Governorate::paginate(15);
        return view(self::VIEW."index" , compact('governorates'));
    }


    public function store(Request $request){
        $roulas= Governorate::rules();
        $validatedData = $request->validate($roulas);
        $next_id=Governorate::get_next_id();
        if($file = $request->file('file')) {
            $fileData = $this->uploads($file,"governorate/$next_id/");
            $validatedData['image'] = $fileData['filePath'] ;
        }


        Governorate::create($validatedData);
        return redirect('/governorate')->with('success', 'Game is successfully saved');

    }
    public function  create(){
        return view(self::VIEW."create");
    }

    public function  edit(Governorate $governorate){
        return view(self::VIEW."edit",compact('governorate'));
    }


    public function  update(Governorate $governorate,Request $request){
        $roulas= Governorate::rules();
        $validatedData = $request->validate($roulas);
  
        if($file = $request->file('file')) {
            $fileData = $this->uploads($file,"governorate/$governorate->id/");
            $validatedData['image'] = $fileData['filePath'] ;
        }

        $governorate->update($validatedData);
        return redirect('/governorate')->with('success', 'Game is successfully saved');
    }

    public function destroy(Governorate $governorate)
    {
        $governorate->delete();
        return redirect('/governorate')->with('success', 'Game Data is successfully deleted');
    }
}
