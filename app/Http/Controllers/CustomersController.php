<?php

namespace App\Http\Controllers;

use App\Models\Customers;
use App\Models\Merchant;
use App\Models\User;
use Illuminate\Http\Request;

class CustomersController extends  Controller
{

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
        $roulas= Customers::rules();
        $validatedData = $request->validate($roulas);
        $next_id=User::get_next_id();
        if($file = $request->file('avatar')) {
            $fileData = $this->uploads($file,"avatar/$next_id");
            $validatedData['avatar'] = $fileData['filePath'] ."/".$fileData['fileName'];
        }

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
        $roulas= Customers::rules();
        $validatedData = $request->validate($roulas);
        $customer->update($validatedData);
        return redirect('/customers')->with('success', 'Game is successfully saved');
    }

    public function destroy(Customers $customer)
    {
        $customer->delete();
        return redirect('/vaila')->with('success', 'Game Data is successfully deleted');
    }
}
