<?php

namespace App\Http\Controllers;

use App\Models\Accounting;
use App\Models\Customers;

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
        $accounting=Accounting::where("user_id",$merchant->id)->sum("for_me","for_app");
        return view(self::VIEW."index" , compact('accounting'));
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
