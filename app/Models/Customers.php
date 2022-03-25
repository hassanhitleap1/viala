<?php

namespace App\Models;

use App\Scopes\CustomerScope;
use App\Scopes\FiltersUsers;

class Customers extends  User
{


    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new CustomerScope());
        static::addGlobalScope(new FiltersUsers());
    }

    public  static function rules(){
        return [
            'name' => 'required',
            'phone' => 'required',
        ];
    }

}
