<?php

namespace App\Http\Controllers;

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
        $orders_count=Orders::count();
        $user_count=User::count();
        $marchant_counr=User::count();
        return view('home',compact('orders_count','user_count','marchant_counr'));
    }
}
