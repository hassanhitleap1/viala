<?php

namespace App\Http\Resources;

use DateTime;
use Illuminate\Http\Resources\Json\JsonResource;

class  BookingHistoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $resource= parent::toArray($request);;

        $resource['comments']= $this->comments;
        $resource['user']= $this->user;
        $resource['imagevaila']= $this->imagevaila;
        $resource['governorate']= $this->governorate;
        $resource["services"]= $this->services;
        $resource["price_now"]=$this->price;
        $resource['thumb']=asset($this->thumb);
        $resource["IsFavorite"]=false;
        $earlier = new DateTime($this->from_date);
        $later = new DateTime($this->to_date);
        $resource['dayes_order']= $later->diff($earlier)->format("%a"); 
        $resource['total_price']=$this->price *$resource['dayes_order']; 
        return  $resource;;
    }
}
