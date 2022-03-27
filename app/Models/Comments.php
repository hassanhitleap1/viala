<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;



class Comments extends  Model
{

    protected  $table='comments';

    protected $guarded = [];

    public  static function rules(){
        return [
            'body' => 'required',
            'vaila_id' => 'required',

        ];
    }


}
