<?php

namespace App\Http\Controllers;

use App\Models\Customers;
use App\Models\Merchant;
use App\Models\Orders;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
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
    public function index()
    {
        $today=date('Y-m-d');
        $total_order=Orders::count();
        $total_order_month=Orders::whereBetween('form_date', [date('Y-m-01'), date('Y-m-t')])->count();
        $First_date_of_week = date_create('this week')->format('Y-m-d H:i:s');
        $Last_date_of_week = date_create('this week +4 days')->format('Y-m-d H:i:s');
        $total_order_week=Orders::whereBetween('form_date', [$First_date_of_week, $Last_date_of_week])->count();
        $total_order_today=Orders::whereBetween('form_date', [$today, $today])->count();
        $user_count=Customers::count();
        $marchant_counr=Merchant::count();
        return view('home',compact('total_order','total_order_today','total_order_week','total_order_month','user_count','marchant_counr'));
    }
}
