<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\FavouriteRequest;
use App\Http\Requests\RateRequest;
use App\Http\Resources\FavouriteResource;
use App\Http\Resources\VailaResource;
use App\Models\Favourite;
use App\Models\Vaila;
use Illuminate\Support\Facades\DB;

class FavouritesController extends Controller
{


    public function __construct()
    {
        $this->middleware('jwt.verify')->only(['myfavourite','index','store','update','show','destroy']);
    }

    


    public function myfavourite(){
        
        
        /*
        return VailaResource::collection(Vaila::where('id',function($q){
            $q->select('vaila_id')->from( 'favourites')->where(
            'user_id',auth('api-jwt')->user()->id);
        })->paginate(10));
        */
        $users_id = auth('api-jwt')->user()->id;
     $sql = "SELECT 
vaila.id ,
vaila.title_en,
vaila.title_ar,
vaila.title_he,
vaila.desc_en,
vaila.desc_ar,
vaila.desc_he,
vaila.thumb,
governorate.name_en,
governorate.name_ar,
governorate.name_he,
vaila.price as price_now,
vaila.price_weekend,
vaila.price_hoolday,
vaila.price_weddings,
vaila.rates
FROM `vaila` 
JOIN favourites on favourites.vaila_id=vaila.id and favourites.user_id=$users_id
JOIN governorate on governorate.id=vaila.governorate_id";
     $results = DB::select( DB::raw($sql) );
      return response()->json([
            'success'=>true,
            'status' => 201,
            'data'=> $results
            ], 422);
    }
    public function store(FavouriteRequest $request){// 
      
      if(Favourite::where('vaila_id',$request->vaila_id)
      ->where('user_id',auth('api-jwt')->user()->id)->count() ){

        Favourite::where('vaila_id',$request->vaila_id)
        ->where('user_id',auth('api-jwt')->user()->id)->delete();

        return response()->json([
            'success'=>true,
            'status' => 201,
            'massage'=>"sucessfully delete from Favourite",
            'data'=>[]
            ], 422);

      }else{
        $Favourite = Favourite::create([
            'vaila_id' => $request->vaila_id,
            'user_id'=> auth('api-jwt')->user()->id
        ]);

        return response()->json([
            'success'=>true,
            'status' => 201,
            'massage'=>"sucessfully add Favourite",
            'data'=>[]
            ], 422);
      }
     
    }


    public function show(Favourite $Favourite){
        return new FavouriteResource($Favourite);
    }

    public function update(Favourite $Favourite,FavouriteRequest $request){

        $Favourite= tap($Favourite)->update($request->all());

        return new FavouriteResource($Favourite);
    }


    public function destroy(Favourite $Favourite){
        $Favourite->delete();
        return Response('',201);
    }





}
