<?php

namespace App\Models;


use App\Scopes\MerchantScope;
use Illuminate\Database\Eloquent\SoftDeletes;

class Merchant extends User
{
    protected $table="users";
    use SoftDeletes;
    public  static function rules(){
        return [
            'name' => 'required',
            'phone' => 'required|unique:users',
            'password'=>'required',
            'email'=>'required|email|unique:users'
        ];
    }
    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new MerchantScope());
//        static::addGlobalScope(new FiltersUsers());
    }
}
