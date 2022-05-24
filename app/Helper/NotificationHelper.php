<?php

namespace App\Helper;

use App\Models\Notification;

class NotificationHelper {
    
    public static function booking_notify($merchant,$type,$user,$from_date,$to_date){
        $notify_array=[];
        $title_en="The villa was booked by $user->name from $from_date to  $to_date";
        $title_ar="تم حجز $user->name من $from_date الى  $to_date";
        $title_he="Vila eshte e rezervuar nga  $user->name from $from_date to  $to_date";
    
        $body_en="The villa was booked by $user->name from $from_date to  $to_date";
        $body_ar="تم حجز $user->name من $from_date الى  $to_date";
        $body_he="Vila eshte e rezervuar nga  $user->name from $from_date to  $to_date";

        $notiy= new Notification() ;
        $notiy->user_id =$merchant->id;
        $notiy->title_en=$title_en;
        $notiy->title_ar=$title_ar;
        $notiy->title_he=$title_he;
        $notiy->body_en=$body_en;
        $notiy->body_ar=$body_ar;
        $notiy->body_he=$body_he;
        $notiy->type= $type;
        $notiy->save();
        FCM::send($merchant->fcm,$title_en ,$title_en);
       
    }
}