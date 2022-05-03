<?php

namespace App\Models;


use App\Scopes\MerchantScope;
use Illuminate\Database\Eloquent\SoftDeletes;

class Merchant extends User
{
    protected $table="users";
    use SoftDeletes;
    public  static function rules($id = null){
        return [
            'create'=>[
                'name' => 'required',
                'phone' => 'required|unique:users',
                'password'=>'required',
                'email'=>'required|email|unique:users'
            ],
            'update'=>[
                'name' => 'required',
                'phone' => 'required|unique:users,phone,'.$id,
                
                'email'=>'required|email|unique:users,email,'.$id,
            ]
           
        ];
    }
    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new MerchantScope());
//        static::addGlobalScope(new FiltersUsers());
    }
}
