<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class MerchantController extends Controller
{

    const VIEW='merchant.';

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function  index(){
        $merchants=Merchant::paginate(15);
        return view(self::VIEW."index" , compact('merchants'));
    }


    public function store(Request $request){
        $roulas= Merchants::rules();
        $validatedData = $request->validate($roulas);
        $next_id=User::get_next_id();
        if($file = $request->file('avatar')) {
            $fileData = $this->uploads($file,"avatar/$next_id");
            $validatedData['avatar'] = $fileData['filePath'] ."/".$fileData['fileName'];
        }

        $model =Merchants::create($validatedData);
        return redirect('/merchants')->with('success', ' successfully saved');

    }
    public function  create(){
        return view(self::VIEW."create");
    }

    public function  edit(Merchants $merchant){
        return view(self::VIEW."edit",compact('merchant'));
    }


    public function  update(Merchants $merchant,Request $request){
        $roulas= Merchants::rules();
        $validatedData = $request->validate($roulas);
        $merchant->update($validatedData);
        return redirect('/merchants')->with('success', 'Game is successfully saved');
    }

    public function destroy(Merchants $merchant)
    {
        $merchant->delete();
        return redirect('/merchants')->with('success', 'Game Data is successfully deleted');
    }
}
