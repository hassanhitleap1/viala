<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Settings  extends  Model
{
   
    protected  $table='settings';

    protected $guarded = [];

    public  static function rules(){
        return [
            'email' => 'required',
            'phone' => 'required',
            'terms_and_conditions_en' => 'required',
            'terms_and_conditions_ar' => 'required',
            'terms_and_conditions_he' => 'required',

            'privacy_policy_en' => 'required',
            'privacy_policy_ar' => 'required',
            'privacy_policy_he' => 'required',

            'about_en' => 'required',
            'about_ar' => 'required',
            'about_he' => 'required',

            

        ];
    }
}
