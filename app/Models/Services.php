<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Services extends    Model
{
    use SoftDeletes;
    protected $table ='services';
    protected $guarded = [];



    public  static function rules(){
        return [
            'name_en' => 'required',
            'name_ar' => 'required',
            'name_he' => 'required',
        ];
    }

}
