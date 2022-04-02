<?php

namespace App\Helper;

class AccountingHelper
{
  public static function calculation_order($price){
      $for_app=$price * 0.20;
      $for_me= $price -$for_app;
      return ['for_app'=>$for_app,'for_me'=>$for_me];
  }

}
