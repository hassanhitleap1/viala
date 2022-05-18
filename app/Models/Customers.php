<?php

namespace App\Models;

use App\Scopes\CustomerScope;
use App\Scopes\FiltersUsers;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customers extends  User
{
    use SoftDeletes;
    protected $table="users";
    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new CustomerScope());
//        static::addGlobalScope(new FiltersUsers());
    }

    public  static function rules($id = null){
        return [
            'create'=>[
                'name' => 'required',
                'phone' => 'required|unique:users,phone',
                'password'=>'required',
                'email'=>'required|email|unique:users,email'
            ],
            'update'=>[
                'name' => 'required',
                'phone' => 'required|unique:users,phone,'.$id,
              
                'email'=>'required|email|unique:users,email,'.$id,
            ]
           
        ];
    }

}
