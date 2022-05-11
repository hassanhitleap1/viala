<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrdersResource extends JsonResource
{

    public function toArray($request)
    {
        $resource=parent::toArray($request);;
        $resource['merchant']=$this->merchant;
        $resource['paymants']=$this->paymants;
        return $resource;
    }
}
