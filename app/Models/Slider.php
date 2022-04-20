<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Slider  extends  Model
{
   
    protected  $table='slider';

    protected $guarded = [];

    public static function rules()
    {
        return [];
    }

    public static function  get_next_id(){
        $statement = DB::select("SHOW TABLE STATUS LIKE 'slider'");
        return $statement[0]->Auto_increment;
    }
}
