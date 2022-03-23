<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class  Governorate extends Model
{

    protected  $table='governorate';

    protected $guarded = [];

    public  static function rules(){
        return [
            'name_en' => 'required',
            'name_er' => 'required',

        ];
    }

}
