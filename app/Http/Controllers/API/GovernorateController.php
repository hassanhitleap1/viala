<?php

namespace App\Http\Controllers\API;

use App\Models\Governorate;


class GovernorateController extends Controller
{


    public function  index(){

        return GovernorateResource::collection(Governorate::all());

    }


}
