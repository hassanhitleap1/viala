<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\GovernorateResource;
use App\Models\Governorate;


class GovernorateController extends Controller
{


    public function  index(){

        return GovernorateResource::collection(Governorate::all());

    }


}
