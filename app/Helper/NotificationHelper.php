<?php

namespace App\Helper;

use App\Models\Notification;

class NotificationHelper {
    
    public static function booking($users ,$title,$body,$type){
        $notify_array=[];
        foreach($users as $user){
            $notify_array[]=[
                'user_id'=>$user->id,
                'title'=>$title,
                'body'=>$body,
                'type'=>$type
            ];
        }
        Notification::insert($notify_array);
    }
}