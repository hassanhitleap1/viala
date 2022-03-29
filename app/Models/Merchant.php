<?php

namespace App\Models;

use App\Scopes\FiltersUsers;
use App\Scopes\MerchantScope;
use Illuminate\Database\Eloquent\SoftDeletes;

class Merchant extends User
{
    protected $table="users";
    use SoftDeletes;
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
//        static::addGlobalScope(new FiltersUsers());
    }
}
