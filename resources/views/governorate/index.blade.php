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
                <th scope="col">name en</th>
                <th scope="col">name ar</th>
                <th scope="col">action</th>

            </tr>
            </thead>
            <tbody>

            @foreach($governorates as  $key => $governorate)
                <tr>
                    <th scope="row">{{++$key}}</th>
                    <td>{{$governorate->name_en}}</td>
                    <td>{{$governorate->name_ar}}</td>
                    <td>
                        <a href="{{url("governorate/$governorate->id/edit")}}">edit</a>

                    </td>

                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

@endsection
