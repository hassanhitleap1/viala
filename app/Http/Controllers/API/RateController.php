<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\RateRequest;
use App\Http\Resources\RateResource;
use App\Models\Rate;
use App\Models\Vaila;


class RateController extends Controller
{


    public function __construct()
    {
        $this->middleware('jwt.verify')->only(['index','store','update','show','destroy']);
    }


    public function store(RateRequest $request){
        $rate= Rate::updateOrCreate([
            'vaila_id' => $request->vaila_id,
            'user_id'=> auth('api-jwt')->user()->id,
        ],[
            'vaila_id' => $request->vaila_id,
            'rate' => $request->rate,
            'user_id'=> auth('api-jwt')->user()->id
        ]);
         $avg= Rate::where('vaila_id',$request->vaila_id)->avg('rate');
        $viala=Vaila::find($request->vaila_id);
        $viala->rates=$avg;
        $viala->save();
        return new RateResource($rate);
    }


    public function show(Rate $rate){
        return new RateResource($rate);
    }

    public function update(Rate $rate,RateRequest $request){

        $rate= tap($rate)->update($request->all());

        return new RateResource($rate);
    }


    public function destroy(Rate $rate){
        $rate->delete();
        return Response('',201);
    }





}
