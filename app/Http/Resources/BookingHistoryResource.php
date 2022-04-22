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

        $earlier = new DateTime($this->from_date);
        $later = new DateTime($this->to_date);
        $resource['dayes_order']= $later->diff($earlier)->format("%a"); 
        $resource['total_price']=$this->price *$resource['dayes_order']; 
        return  $resource;;
    }
}
