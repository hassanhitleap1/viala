<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\NotificationResource;
use App\Models\Notification;



class NotificationController extends Controller
{


    public function __construct()
    {
          $this->middleware('jwt.verify')->only(['index']);
    }
    public function index(){
        
        return NotificationResource::collection(Notification::where('user_id',auth('api-jwt')->user()->id)->paginate(10));      
       
    }









}
