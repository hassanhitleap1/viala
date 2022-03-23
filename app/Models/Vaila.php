<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vaila extends  Model
{

    protected  $table='vaila';

    protected $guarded = [];

    public  static function rules(){
        return [
            'title' => 'required',
            'desc' => 'required',
            'new_arrivals' => 'required',
            'special'=>'required',
            'has_pool'=>'required',
            'has_barbikio'=>'required',
            'has_parcking'=>'required',
            'for_shbab'=>'required',
            'price'=>'required',
            'price_weekend'=>'required',
            'price_hoolday'=>'required',
            'number_room'=>'required',
            'number_booking'=>'required',
        ];
    }

}
