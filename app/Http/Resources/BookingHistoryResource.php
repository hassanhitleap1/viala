<?php

namespace App\Http\Resources;

use Carbon\Carbon;
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
        $resource['form_date']= date("Y-m-d", strtotime( $this->form_date));  
        $resource['to_date']= date("Y-m-d", strtotime( $this->to_date)); 
      

        $resource['comments']= $this->comments;
        $resource['user']= $this->user;
        $resource['imagevaila']= $this->imagevaila;
        $resource['governorate']= $this->governorate;
        $resource["services"]= $this->services;
        $resource["price_now"]=$this->price;
        $resource['thumb']=asset($this->thumb);
        $resource["IsFavorite"]=false;
        $earlier = new DateTime($this->form_date);
        $later = new DateTime($this->to_date);
        $resource['dayes_order']= $later->diff($earlier)->format("%a") + 1;  
        $resource['total_price']=$this->price *$resource['dayes_order']; 
        $resource["form_date_day_ar"]=  Carbon::parse($this->form_date)->locale('ar')->dayName ;
        $resource["form_date_day_en"]=Carbon::parse($this->form_date)->locale('en')->dayName ;
        $resource["to_date_day_ar"]=  Carbon::parse($this->to_date)->locale('ar')->dayName ;
        $resource["to_date_day_en"]=Carbon::parse($this->to_date)->locale('en')->dayName ;
        return  $resource;;
    }
}
