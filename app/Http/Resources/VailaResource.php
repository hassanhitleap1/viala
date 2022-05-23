<?php

namespace App\Http\Resources;

use App\Helper\AccountingHelper;
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
        $resource['imagevaila']= ImageVailaResource::collection($this->imagevaila);
        $resource['governorate']= $this->governorate;
        $resource['reservations']=  ReservationsResource::collection($this->reservations);
        $resource["services"]= ServicesResource::collection($this->services);
        $resource["price_now"]=AccountingHelper::getPrice($this);
        $resource['thumb']=asset($this->thumb);
        $resource["IsFavorite"]=false;
        $resource['entry_hour'] = date('h:i A', strtotime($this->entry_hour));
        $resource['out_hour'] =  date('h:i A', strtotime($this->out_hour));
        
  
        return $resource;
    }
}
