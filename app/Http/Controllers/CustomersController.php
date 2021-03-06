<?php

namespace App\Http\Controllers;

use App\Helper\Media;
use App\Models\Customers;
use App\Models\Merchant;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class CustomersController extends  Controller
{

    use Media;
    const VIEW='customers.';

    public function __construct()
    {
        $this->middleware('auth');
    }
    public function  index(){
        $customers=Customers::paginate(15);
        return view(self::VIEW."index" , compact('customers'));
    }


    public function store(Request $request){
        $roulas= Customers::rules()['create'];
        $validatedData = $request->validate($roulas);
        $next_id=User::get_next_id();
        if($file = $request->file('avatar')) {
            $fileData = $this->uploads($file,"avatar/$next_id/");
            $validatedData['avatar'] =  $fileData['filePath'] ;
        }

        $validatedData['password']=  Hash::make($validatedData['password']);
        $validatedData['type']=User::CUSTOMER; 


        $model =Customers::create($validatedData);
        return redirect('/customers')->with('success', ' successfully saved');

    }
    public function  create(){
        return view(self::VIEW."create");
    }

    public function  edit(Customers $customer){
        return view(self::VIEW."edit",compact('customer'));
    }


    public function  update(Customers $customer,Request $request){
        $roulas= Customers::rules($customer->id)['update'];
        $validatedData = $request->validate($roulas);
        if($file = $request->file('avatar')) {
            $fileData = $this->uploads($file,"avatar/$customer->id/");
            $validatedData['avatar'] =  $fileData['filePath'] ;
        }

        $customer->update($validatedData);
        return redirect('/customers')->with('success', 'Game is successfully saved');
    }

    public function destroy(Customers $customer)
    {
        $customer->delete();
        return redirect('/customers')->with('success', 'Game Data is successfully deleted');
    }

    public function active(Customers $customer)
    {
        
        $customer->status=1;
        $customer->save();
        return redirect('/customers')->with('success', 'Game Data is successfully ');
    }

    public function disactive(Customers $customer)
    {

        $customer->status=0;
        $customer->save();
        
        return redirect('/customers')->with('success', 'Game Data is successfully ');
    }
}
