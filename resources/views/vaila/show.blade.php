@extends('layouts.admin')

@section('content')



    <div class="container">
        <h1> {{$vaila->title}} </h1>
        
        <div class="container">
            <div class="row">
                <div class="col">
                   {{__('code')}}  
                </div>
                <div class="col">
                    {{$vaila->code}}
                </div>
               
            </div>
            <hr/>
                 


            <div class="row">
                <div class="col">
                   {{__('entry hour')}}  
                </div>
                <div class="col">
                    {{$vaila->entry_hour}}
                </div>
               
            </div>
            <hr/>


            <div class="row">
                <div class="col">
                   {{__('out hour')}}  
                </div>
                <div class="col">
                    {{$vaila->out_hour}}
                </div>
               
            </div>
            <hr/>

            <div class="row">
                <div class="col">
                   {{__('marchant')}}  
                </div>
                <div class="col">
                {{$vaila->user->name}}
                </div>
               
            </div>
            <hr/>

            <div class="row">
                <div class="col">
                   {{__('title english')}}  
                </div>
                <div class="col">
                {{$vaila->title_en}}
                </div>
               
            </div>
            <hr/>


            <div class="row">
                <div class="col">
                   {{__('desc english')}}  
                </div>
                <div class="col">
                {{$vaila->desc_en}}
                </div>
               
            </div>
            <hr/>


            <div class="row">
                <div class="col">
                   {{__('title arabic')}}  
                </div>
                <div class="col">
                {{$vaila->title_ar}}
                </div>
               
            </div>
            <hr/>


            <div class="row">
                <div class="col">
                   {{__('desc arabic')}}  
                </div>
                <div class="col">
                {{$vaila->desc_ar}}
                </div>
               
            </div>
            <hr/>


            <div class="row">
                <div class="col">
                   {{__('price')}}  
                </div>
                <div class="col">
                {{$vaila->price}}
                </div>
               
            </div>
            <hr/>




            
            <div class="row">
                <div class="col">
                   {{__('price weekend')}}  
                </div>
                <div class="col">
                {{$vaila->price_weekend}}
                </div>
               
            </div>
            <hr/>


            <div class="row">
                <div class="col">
                   {{__('price hoolday')}}  
                </div>
                <div class="col">
                {{$vaila->price_hoolday}}
                </div>
               
            </div>
            <hr/>


            <div class="row">
                <div class="col">
                   {{__('price weddings')}}  
                </div>
                <div class="col">
                {{$vaila->price_weddings}}
                </div>
               
            </div>
            <hr/>


            <div class="row">
                <div class="col">
                   {{__('area')}}  
                </div>
                <div class="col">
                {{$vaila->area}}
                </div>
               
            </div>
            <hr/>



            <div class="row">
                <div class="col">
                   {{__('insurance amount')}}  
                </div>
                <div class="col">
                {{$vaila->insurance_amount}}
                </div>
               
            </div>
            <hr/>


            
            <div class="row">
                <div class="col">
                   {{__('retainer')}}  
                </div>
                <div class="col">
                {{$vaila->retainer}}
                </div>
               
            </div>
            <hr/>


            <div class="row">
                <div class="col">
                   {{__('number room')}}  
                </div>
                <div class="col">
                {{$vaila->number_room}}
                </div>
               
            </div>
            <hr/>


            
            <div class="row">
                <div class="col">
                   {{__('reagin')}}  
                </div>
                <div class="col">
                {{$vaila->governorate->name_ar}}
                </div>
               
            </div>
            <hr/>


                      
            <div class="row">
                <div class="col">
                   {{__('weddings')}}  
                </div>
                <div class="col">
                {{\App\Helper\StatusHelper::has_attribuate($vaila->weddings)}}
                </div>
               
            </div>
            <hr/>

            <div class="row">
                <div class="col">
                   {{__('new arrivals')}}  
                </div>
                <div class="col">
                {{\App\Helper\StatusHelper::has_attribuate($vaila->new_arrivals)}}
                </div>
               
            </div>
            <hr/>

            <div class="row">
                <div class="col">
                   {{__('for shbab')}}  
                </div>
                <div class="col">
                {{\App\Helper\StatusHelper::has_attribuate($vaila->for_shbab)}}
                </div>
               
            </div>
            <hr/>

            @foreach($vaila->services as $service)
            <hr/>
             <div class="row">
                <div class="col">
                {{$service->name_ar}}
                </div>
                <div class="col">
                نعم
                </div>
            </div>

            @endforeach



            <div class="row">
                <div class="col">
                   {{__('image vaila')}}  
                </div>
                <div class="col">
                    <img  class="img-fluid img-thumbnail" src="{{asset($vaila->thumb)}}  " width="250" height="20">
                </div>
               
            </div>
            <hr/>


            <div class="row">
                <div class="col">
                   {{__('image vaila')}}  
                   @foreach($vaila->imagevaila as $img)
                        <img  class="img-fluid img-thumbnail" src="{{asset($img->path)}}  " width="250" height="20">
                    @endforeach
                </div>
                
               
            </div>
            <hr/>



        </div>
    </div>

                            
                           
@endsection
