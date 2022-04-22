@extends('layouts.admin')

@section('content')


    <div class="container">
        <h1> {{$vaila->title}} </h1>
        
        <div class="container">
            <div class="row">
                <div class="col">
                    title
                </div>
                <div class="col">
                    {{$vaila->title_en}}
                </div>
                <div class="col">
                    {{$vaila->title_ar}}
                </div>
                <div class="col">
                    {{$vaila->title_he}}
                </div>
            </div>
            <hr/>

            <div class="row">
                <div class="col">
                    descroption
                </div>
                <div class="col">
                    {{$vaila->desc_en}}
                </div>
                <div class="col">
                    {{$vaila->desc_ar}}
                </div>
                <div class="col">
                    {{$vaila->desc_he}}
                </div>
            </div>
            <hr/>
            <div class="row">
                <div class="col">
                status
                </div>
                <div class="col">
                {{\App\Helper\StatusHelper::keyword_status($vaila->status)}}
                </div>
            </div>
            <hr/>
            <div class="row">
                <div class="col">
                new arrivals
                </div>
                <div class="col">
                {{\App\Helper\StatusHelper::has_attribuate($vaila->new_arrivals)}}
                </div>
            </div>
            <hr/>
            <div class="row">
                <div class="col">
                special
                </div>
                <div class="col">
                {{\App\Helper\StatusHelper::has_attribuate($vaila->special)}}
                </div>
            </div>
            <hr/>
            <div class="row">
                <div class="col">
                user
                </div>
                <div class="col">
                {{$vaila->user->name}}
                </div>
            </div>
            
            <hr/>
            <div class="row">
                <div class="col">
                governorate
                </div>
                <div class="col">
                {{$vaila->governorate->name_en}}
             
                </div>
            </div>
            <hr/>
            <div class="row">
                <div class="col">
                has pool
                </div>
                <div class="col">
                {{\App\Helper\StatusHelper::has_attribuate($vaila->has_pool)}}
                </div>
            </div>
            <hr/>
            <div class="row">
                <div class="col">
                has barbikio
                </div>
                <div class="col">
                {{\App\Helper\StatusHelper::has_attribuate($vaila->has_barbikio)}}
                </div>
            </div>
            
            <hr/>
            <div class="row">
                <div class="col">
                for shbab
                </div>
                <div class="col">
                {{\App\Helper\StatusHelper::has_attribuate($vaila->for_shbab)}}
                </div>
            </div>
            
            <hr/>
            <div class="row">
                <div class="col">
                for shbab
                </div>
                <div class="col">
                {{$vaila->price}}
                </div>
            </div>
            <hr/>

            <div class="row">
                <div class="col">
                price hoolday
                </div>
                <div class="col">
                {{$vaila->price_hoolday}}
                </div>
            </div>
            <hr/>
            <div class="row">
                <div class="col">
                price weekend
                </div>
                <div class="col">
                {{$vaila->price_weekend}}
                </div>
            </div>
            
            <hr/>
            <div class="row">
                <div class="col">
                number room
                </div>
                <div class="col">
                {{$vaila->number_room}}
                </div>
            </div>
            <hr/>
            

            <div class="row">
                <div class="col">
                garden
                </div>
                <div class="col">
                {{\App\Helper\StatusHelper::has_attribuate($vaila->garden)}}
                </div>
            </div>
            
            <hr/>
            <div class="row">
                <div class="col">
                conditioners
                </div>
                <div class="col">
                {{\App\Helper\StatusHelper::has_attribuate($vaila->conditioners)}}
                </div>
            </div>
            <hr/>

            <div class="row">
                <div class="col">
                wifi
                </div>
                <div class="col">
                {{\App\Helper\StatusHelper::has_attribuate($vaila->wifi)}}
                </div>
            </div>
            <hr/>
            <div class="row">
                <div class="col">
                wifi
                </div>
                <div class="col">
                {{\App\Helper\StatusHelper::has_attribuate($vaila->wifi)}}
                </div>
            </div>
            <hr/>
            <div class="row">
                <div class="col">
                view
                </div>
                <div class="col">
                {{$vaila->view}}
                </div>
            </div>
            <hr/>
            <div class="row">
                <div class="col">
                number booking
                </div>
                <div class="col">
                {{$vaila->number_booking}}
                </div>
            </div>
            <hr/>
            <div class="row">
                <div class="col">
                rates
                </div>
                <div class="col">
                {{$vaila->rates}}
                </div>
            </div>
            <hr/>
             <div class="row">
                <div class="col">
                insurance amount
                </div>
                <div class="col">
                {{$vaila->insurance_amount}}
                </div>
            </div>
            
            @foreach($vaila->services as $service)
            <hr/>
             <div class="row">
                <div class="col">
                {{$service->name_en}}
                </div>
                <div class="col">
                true
                </div>
            </div>

            @endforeach
           
        </div>

    </div>

@endsection
