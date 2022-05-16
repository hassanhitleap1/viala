<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Resources\Json\JsonResource;

class OrdersResource extends JsonResource
{

    public function toArray($request)
    {
        $resource=parent::toArray($request);;
        $resource['form_date']= date("Y-m-d", strtotime( $this->form_date));  
        $resource['to_date']= date("Y-m-d", strtotime( $this->to_date)); 
        $resource['merchant']=$this->merchant;
        $resource['paymants']=$this->paymants;
        $earlier = new DateTime($this->from_date);
        $later = new DateTime($this->to_date);
        $resource['dayes_order']= $later->diff($earlier)->format("%a") + 1;  
        $resource["form_date_day_ar"]=  Carbon::parse($this->from_date)->locale('ar')->dayName ;
        $resource["form_date_day_en"]=Carbon::parse($this->from_date)->locale('en')->dayName ;
        $resource["to_date_day_ar"]=  Carbon::parse($this->to_date)->locale('ar')->dayName ;
        $resource["to_date_day_en"]=Carbon::parse($this->to_date)->locale('en')->dayName ;
        
        return $resource;
    }
}
