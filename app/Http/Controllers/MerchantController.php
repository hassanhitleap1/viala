<?php

namespace App\Http\Controllers;

use App\Helper\Media;
use App\Models\Merchant;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class MerchantController extends Controller
{
    use Media;
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
        $roulas= Merchant::rules()['create'];
        $validatedData = $request->validate($roulas);
        $next_id=User::get_next_id();
        if($file = $request->file('avatar')) {
            $fileData = $this->uploads($file,"avatar/$next_id/");
            $validatedData['avatar'] =  $fileData['filePath'] ;
        }

        $validatedData['password']=  Hash::make($validatedData['password']);
        $validatedData['type']=User::Merchant; 
        $model =Merchant::create($validatedData);
        return redirect('merchant')->with('success', ' successfully saved');

    }
    public function  create(){
        return view(self::VIEW."create");
    }

    public function  edit(Merchant $merchant){
        return view(self::VIEW."edit",compact('merchant'));
    }


    public function  update(Merchant $merchant,Request $request){
        $roulas= Merchant::rules($merchant->id)['update'];
        $validatedData = $request->validate($roulas);
        if($file = $request->file('avatar')) {
            $fileData = $this->uploads($file,"avatar/$merchant->id/");
            $validatedData['avatar'] =  $fileData['filePath'] ;
        }
        $merchant->update($validatedData);
        return redirect('merchant')->with('success', 'Game is successfully saved');
    }

    public function destroy(Merchant $merchant)
    {
        $merchant->delete();
        return redirect('merchant')->with('success', 'Game Data is successfully deleted');
    }

    public function active(Merchant $merchant)
    {

               
        $merchant->status=1;
        $merchant->save();

        return redirect('merchant')->with('success', 'Game Data is successfully ');
    }

    public function disactive(Merchant $merchant)
    {
        $merchant->status=0;
        $merchant->save();
        return redirect('merchant')->with('success', 'Game Data is successfully ');
    }
}
