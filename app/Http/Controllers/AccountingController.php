<?php

namespace App\Http\Controllers;

use App\Models\Accounting;
use App\Models\Customers;
use App\Models\Merchant;

class AccountingController  extends Controller
{
    const VIEW='accounting.';
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Merchant $merchant)
    {
     
        $for_app=Accounting::where('user_id',$merchant->id)->sum('for_app');
        $for_me=Accounting::where('user_id',$merchant->id)->sum('for_me');
     
        return view(self::VIEW."index" , compact('for_app','for_me','merchant'));
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function delete(Merchant $merchant)
    {
        Accounting::where("user_id",$merchant->id)->delete();
        return redirect("accounting/$merchant->id")->with('success', 'Game Data is successfully deleted');
    }
}
