<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\SliderResource;
use App\Models\Slider;

class sliderController extends Controller
{


    public function index(){
        return  SliderResource::collection(Slider::all());
    }


  


}
