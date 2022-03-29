<?php

namespace App\Http\Controllers\API;

use App\Models\Governorate;
use Illuminate\Http\Request;

class GovernorateController extends Controller
{
    const VIEW='governorate.';

    public function  index(){

        return GovernorateResource::collection(Governorate::all());

    }


}
