<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class  OrderResource extends JsonResource
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
        $resource['from_date']= date("Y-m-d", strtotime( $this->form_date));  
        $resource['to_date']= date("Y-m-d", strtotime( $this->to_date)); 
        $resource['merchant']=$this->merchant;
        $resource['paymants']=$this->paymants;
        return $resource;
    }
}
