<?php


namespace App\Rules;

use App\Models\Orders;
use Illuminate\Contracts\Validation\Rule;

class OrderRules implements Rule
{
   public function passes($attribute, $value)
   {
   
   }


  public function message()
  {
     return 'error message...';
  }
}