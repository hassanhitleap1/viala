<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;




class Favourite extends  Model
{

    protected  $table='favourites';

    protected $guarded = [];

    public  static function rules(){
        return [
            'vaila_id' => 'required',

        ];
    }


}
