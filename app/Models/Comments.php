<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;



class Comments extends  Model
{
    use SoftDeletes;
    protected  $table='comments';

    protected $guarded = [];

    public  static function rules(){
        return [
            'body' => 'required',
            'vaila_id' => 'required',

        ];
    }


}
