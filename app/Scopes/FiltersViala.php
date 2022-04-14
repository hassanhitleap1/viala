<?php

namespace App\Scopes;


use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class FiltersViala implements Scope
{


    /**
     * Apply the scope to a given Eloquent query builder.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $builder
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @return void
     */
    public function apply(Builder $builder, Model $model)
    {
        if(isset($_GET['title']) && $_GET['title'] != ''){
            $builder->where('name', 'like', "%".$_GET['title']."%");
        }

        if(isset($_GET['new_arrivals']) && $_GET['new_arrivals'] == true){
            $builder->where('new_arrivals', '=', 1);
        }

        if(isset($_GET['special']) && $_GET['special'] == true){
            $builder->where('special', '=', 1);
        }

        if(isset($_GET['has_pool']) && $_GET['has_pool'] == true){
            $builder->where('has_pool', '=', 1);
        }

        if(isset($_GET['has_barbikio']) && $_GET['has_barbikio'] == true){
            $builder->where('has_barbikio', '=', 1);
        }

        if(isset($_GET['has_parcking']) && $_GET['has_parcking'] == true){
            $builder->where('has_parcking', '=', 1);
        }

        if(isset($_GET['for_shbab']) && $_GET['for_shbab'] == true){
            $builder->where('for_shbab', '=', 1);
        }

        if(isset($_GET['price']) && $_GET['price'] != ""){
            $builder->where('price', '=', $_GET['price']);
        }


        if(isset($_GET['price_weekend']) && $_GET['price_weekend'] != ""){
            $builder->where('price_weekend', '=', $_GET['price_weekend']);
        }

        if(isset($_GET['price_weekend']) && $_GET['price_weekend'] != ""){
            $builder->where('price_weekend', '=', $_GET['price_weekend']);
        }


        if(isset($_GET['price_hoolday']) && $_GET['price_hoolday'] != ""){
            $builder->where('price_hoolday', '=', $_GET['price_hoolday']);
        }

        if(isset($_GET['number_room']) && $_GET['number_room'] != ""){
            $builder->where('number_room', '=', $_GET['number_room']);
        }


        if(isset($_GET['governorate_id']) && $_GET['governorate_id'] != ""){
            $builder->where('governorate_id', '=', $_GET['governorate_id']);
        }


        if(isset($_GET['garden']) && $_GET['garden'] == true){
            $builder->where('garden', '=', 1);
        }
        if(isset($_GET['conditioners']) && $_GET['conditioners'] == true){
            $builder->where('conditioners', '=', 1);
        }
        if(isset($_GET['kitchen']) && $_GET['kitchen'] == true){
            $builder->where('kitchen', '=', 1);
        }
        if(isset($_GET['wifi']) && $_GET['wifi'] == true){
            $builder->where('wifi', '=', 1);
        }

        if(isset($_GET['user_id']) && $_GET['user_id'] == true){
            $builder->where('user_id', '=', $_GET['user_id']);
        }


    }
}