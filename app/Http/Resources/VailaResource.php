<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class  VailaResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {

        $resource=parent::toArray($request);
        $resource['comments']= $this->comments;
        $resource['user']= $this->user;
        $resource['imagevaila']= $this->imagevaila;
        $resource['governorate']= $this->governorate;
        $resource["services"]= $this->services;
        $resource["price_now"]=$this->price;
        $resource['thumb']=asset($this->thumb);
        $resource["IsFavorite"]=false;
        return $resource;
    }
}
