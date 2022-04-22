@extends('layouts.admin')

@section('content')


    <div class="container">
        <h1> {{$vaila->title}} </h1>
        <a class="btn btn-secondary pull-right" href="{{url('vaila/create')}}"> {{__('create new vaila')}}</a>
        <hr />

        <div class="container">
            <div class="row">
                <div class="col">
                    title
                </div>
                <div class="col">
                    {{$vaila->title}}
                </div>
            </div>
            <div class="row">
                <div class="col">
                    arrival
                </div>
                <div class="col">
                    2 of 3
                </div>
                <div class="col">
                    3 of 3
                </div>
            </div>
        </div>

    </div>

@endsection
