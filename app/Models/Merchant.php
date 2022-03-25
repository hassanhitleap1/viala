<?php

namespace App\Models;

use App\Scopes\FiltersUsers;
use App\Scopes\MerchantScope;

class Merchant extends User
{
    public  static function rules(){
        return [
            'name' => 'required',
            'phone' => 'required',
        ];
    }
    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new MerchantScope());
        static::addGlobalScope(new FiltersUsers());
    }
}
