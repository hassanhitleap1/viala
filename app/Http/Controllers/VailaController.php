<?php

namespace App\Http\Controllers;

use App\Helper\Media;
use App\Models\Governorate;
use App\Models\ImageVaila;
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
        $roulas= Vaila::rules();
        $validatedData = $request->validate($roulas);
        $validatedData['number_booking']=0;
        $validatedData['status']=0;
        $validatedData['user_id']=auth()->user()->id;
        $validatedData['number_booking']=0;
        $next_id=Vaila::get_next_id();

        if($file = $request->file('thumb')) {
            $fileData = $this->uploads($file,"vailas/$next_id");
            $validatedData['thumb'] = $fileData['filePath'] ."/".$fileData['fileName'];
        }
        unset($validatedData['images']);
        $model =Vaila::create($validatedData);

        $images=[];
        if($files = $request->file('images')) {
            foreach ($files as $file){
                $fileData = $this->uploads($file,"vailas/$next_id/images");
                $images []=[
                        'path' =>  $fileData['filePath'] ."/".$fileData['fileName'],
                        'vaila_id'=> $model->id
                    ];

            }

            if(count($images))
                ImageVaila::create($images);
        }

        return redirect('/vaila')->with('success', 'Game is successfully saved');

    }
    public function  create(){
        $governorates=Governorate::all();
        return view(self::VIEW."create",compact('governorates'));
    }

    public function  edit(Vaila $vaila){
        $governorates=Governorate::all();
        return view(self::VIEW."edit",compact('vaila','governorates'));
    }

    public function show(Vaila $vaila){
        return view(self::VIEW."show",compact('vaila'));
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
