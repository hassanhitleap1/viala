<?php

namespace App\Scopes;

use App\Helper\AuthHelper;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Tymon\JWTAuth\Facades\JWTAuth;

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
       
        
        // if(AuthHelper::checkAuth()){
        //     dd("ddd");
        // }

        // $builder->select('vaila.*','favourites.id as is_fivarate');
        // $builder->leftjoin('favourites', function($q){
        //     $q->on('favourites.vaila_id','=','vaila.id');
        //     $q->where('user_id',auth('api-jwt')->user()->id);
        //     $q->limt(1);
        // })  ; 

   
        // try {
        //     if (! $token = JWTAuth::parseToken()) {
               
        //         $builder->select('vaila.*','favourites.id as is_fivarate');
        //         $builder->leftjoin('favourites', function($q){
        //             $q->on('favourites.vaila_id','=','vaila.id');
        //             $q->where('user_id',auth('api-jwt')->user()->id);
        //             $q->limt(1);
        //         })  ; 
        //     }

        // } catch (Exception $e) {

        // }
      


     

        if(isset($_GET['search']) && $_GET['search'] != ''){
            $builder->where(function($q){
                $q->orwhere('title_en', 'like', "%".$_GET['search']."%");
                $q->orwhere('title_ar', 'like', "%".$_GET['search']."%");
                $q->orwhere('title_he', 'like', "%".$_GET['search']."%");
                $q->orwhere('desc_en', 'like', "%".$_GET['search']."%");
                $q->orwhere('desc_ar', 'like', "%".$_GET['search']."%");
                $q->orwhere('desc_he', 'like', "%".$_GET['search']."%");
            });
            
          
        }



        if(isset($_GET['services']) && is_array($_GET['services']) ){
            $builder->whereIn('id',function($q){
                $q->select('vaila_id')->from('vaial_services')
                ->whereIn('services_id', $_GET['services'] );
               
            });
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


        if(isset($_GET['main_price']) && $_GET['main_price'] != ""){
            $builder->where('price', '<=', $_GET['main_price']);
        }
        
        if(isset($_GET['from_date']) && $_GET['from_date'] != "" && isset($_GET['to_date']) && $_GET['to_date']){
           
            $builder->where('id',function($q){
                $q->select('vaial_id')->from('orders')
                ->whereNotBetween('form_date', [$_GET['form_date'] , $_GET['to_date'] ])
                ->whereNotBetween('to_date', [$_GET['form_date'] , $_GET['to_date'] ]);
            });
        }




    }
}
