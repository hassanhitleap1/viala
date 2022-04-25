<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Holiday extends Model
{
 
    protected $table ='holiday';
    protected $guarded = [];



    public  static function rules(){
        return [
            'name' => 'required',
            'date' => 'required',
           
        
        ];
    }


    
}
