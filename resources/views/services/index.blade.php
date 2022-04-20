@extends('layouts.admin')

@section('content')


    <div class="container">
        <h1> services </h1>
        <a class="btn btn-secondary pull-right" href="{{url('services/create')}}"> {{__('create new services')}}</a>
        <hr />
        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">name_he</th>
                <th scope="col">desc</th>
                <th scope="col">arrival</th>
            

            </tr>
            </thead>
            <tbody>

            @foreach($services  as $key => $service)
                <tr>
                    <th scope="row">{{$key}}</th>
                    <td>{{$service->name_ar}}</td>
                    <td>{{$service->name_en}}</td>
                    <td>{{$service->name_he }}</td>
                  
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

@endsection
