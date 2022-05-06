<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

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


    

    public static function  get_next_id(){
        $statement = DB::select("SHOW TABLE STATUS LIKE 'governorate'");
        return $statement[0]->Auto_increment;
    }

}
