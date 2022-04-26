@extends('layouts.admin')

@section('content')


    <div class="container">
        <h1> governorate </h1>
        <a class="btn btn-secondary pull-right" href="{{url('governorate/create')}}"> {{__('create new governorate')}}</a>
        <hr />
        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">name english</th>
                <th scope="col">name arabic</th>
                <th scope="col">name Hebrew</th>
                <th scope="col">image</th>
                
                <th scope="col">action</th>

            </tr>
            </thead>
            <tbody>

            @foreach($governorates as  $key => $governorate)
                <tr>
                    <th scope="row">{{++$key}}</th>
                    <td>{{$governorate->name_en}}</td>
                    <td>{{$governorate->name_ar}}</td>
                    <td>{{$governorate->name_he}}</td>
                    <td> <img src="{{asset($governorate->image)}}" width="250" height="25"> </td>
                    <td>
                        <a href="{{url("governorate/$governorate->id/edit")}}"><i class="fas fa-edit"></i> </a>

                        <form action="{{route("governorate.destroy",$governorate->id)}}" method="POST">
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
