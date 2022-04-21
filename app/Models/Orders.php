<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Orders  extends Model
{
   use SoftDeletes;
    protected  $table='orders';

    protected $guarded = [];


    public function vaila(){
        return $this->hasOne(Vaila::class,'id','vaial_id')->join('users','users.id','vaial_id');
    }

    public function merchant(){
        return $this->hasOne(Vaila::class,'id','vaial_id')
        ->join('users','users.id','vaila.user_id');
    }

}
