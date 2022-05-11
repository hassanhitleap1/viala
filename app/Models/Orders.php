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
        return $this->hasOne(Vaila::class,'id','vaial_id')
        ->join('users','users.id','vaila.user_id');
    }

    public function merchant(){
        return $this->hasOne(Vaila::class,'id','vaial_id')
        ->join('users','users.id','vaila.user_id');
    }

    
    public function paymants(){
        return $this->hasMany(Paymants::class,'id','order_id');
    }

    
}
