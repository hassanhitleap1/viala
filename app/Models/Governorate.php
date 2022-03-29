<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class  Governorate extends Model
{

    use SoftDeletes;
    protected  $table='governorate';

    protected $guarded = [];

    public  static function rules(){
        return [
            'name_en' => 'required',
            'name_ar' => 'required',

        ];
    }

}
