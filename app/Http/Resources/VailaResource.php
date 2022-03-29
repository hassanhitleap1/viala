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
        $resource['comments']= $request->comments;
        $resource['user']= $request->user;
        $resource['imagevaila']= $request->imagevaila;
        $resource['governorate']= $request->governorate;
        return $resource;
    }
}
