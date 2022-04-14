<?php

namespace App\Http\Controllers\Jobs;

use App\Helper\FCM;
use App\Helper\NotificationHelper;
use App\Http\Controllers\Controller;
use App\Models\Orders;
use Carbon\Carbon;

class NotificationController  extends Controller
{

  

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function send()
    {
        $date = Carbon::now();
        $title="";
        $body="";
        $users=Orders::where('form_date',$date)->get();
        NotificationHelper::booking($users,$title,$body,1);
        FCM::sendForUsers($users,$title,$body);

    }

    
}
