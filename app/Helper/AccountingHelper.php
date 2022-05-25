<?php

namespace App\Helper;

use App\Models\Holiday;
use Carbon\Carbon;

class AccountingHelper
{
  public static function calculation_order($price){
      $for_app=$price * 0.10;
      $for_me= $price - $for_app;
      return ['for_app'=>$for_app,'for_me'=>$for_me];
  }

  public static function getPrice($vaial){
    if(Holiday::where('date',date('Y-m-d'))->count()){
      return $vaial->price_hoolday;
    }elseif(Carbon::now()->locale('en')->dayName== "Thursday" || Carbon::now()->locale('en')->dayName =="Friday"){
      return $vaial->price_weekend;
    }else{
      return $vaial->price;
    }

    
    

  }

}
