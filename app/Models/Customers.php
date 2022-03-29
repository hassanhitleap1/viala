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

    public  static function rules(){
        return [
            'name' => 'required',
            'phone' => 'required',
        ];
    }

}
