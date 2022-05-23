<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class  ReservationsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $resource=parent::toArray($request);;
        $resource['form_date']= date("Y-m-d", strtotime( $this->form_date));  
        $resource['to_date']= date("Y-m-d", strtotime( $this->to_date)); 
 
        return $resource;
    }
}
