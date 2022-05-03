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
                <th scope="col"> {{__('name arabic')}} </th>
                <th scope="col"> {{__('name english')}} </th>
                <th scope="col">{{__('name Hebrew')}} </th>
                <th scope="col"> {{__('image')}} </th>
            

            </tr>
            </thead>
            <tbody>

            @foreach($services  as $key => $service)
                <tr>
                    <th scope="row">{{$key}}</th>
                    <td>{{$service->name_ar}}</td>
                    <td>{{$service->name_en}}</td>
                    <td>{{$service->name_he }}</td>
                    <td> <img src="{{asset($service->image)}}" class="img-fluid img-thumbnail" width="250" height="25"> </td>
                    <td>
                    <a href="{{url("services/$service->id/edit")}}"><i class="fas fa-edit"></i> </a>

                    <form action="{{route("services.destroy",$service->id)}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" title="delete" style="border: none; background-color:transparent;">
                            <i class="fas fa-trash fa-lg text-danger"></i>
                        </button>
                    </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

@endsection
