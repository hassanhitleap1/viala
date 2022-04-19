<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\ServicesResource;
use App\Models\Services;


class ServicesController extends Controller
{


    public function index(){
        return  ServicesResource::collection(Services::all());
    }


  


}
