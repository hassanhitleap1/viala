@extends('layouts.admin')

@section('content')


    <div class="container">
        <h1> vaila </h1>
        <a class="btn btn-secondary pull-right" href="{{url('vaila/create')}}"> {{__('create new vaila')}}</a>
        <hr />
        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">title</th>
                <th scope="col">desc</th>
                <th scope="col">arrival</th>
                <th scope="col">status</th>
                <th scope="col">has pool</th>
                <th scope="col">special</th>
                <th scope="col">has barbikio</th>
                <th scope="col">thumbnuil</th>
                <th scope="col">action</th>

            </tr>
            </thead>
            <tbody>

            @foreach($vailas as $key => $vaila)
                <tr>
                    <th scope="row">{{$key}}</th>
                    <td>{{$vaila->title}}</td>
                    <td>{{$vaila->desc}}</td>
                    <td>{{$vaila->new_arrivals ? 'new arrival': 'not new'}}</td>
                    <td>{{\App\Helper\StatusHelper::keyword_status($vaila->status)}}</td>
                    <td> {{\App\Helper\StatusHelper::has_attribuate($vaila->has_pool)}}</td>
                    <td> {{\App\Helper\StatusHelper::has_attribuate($vaila->special)}}</td>
                    <td> {{\App\Helper\StatusHelper::has_attribuate($vaila->has_barbikio)}}</td>
                    <td> <img src="{{asset($vaila->thumb)}}" width="250" height="25"> </td>
                    <td>
                        <a href="{{url("vaila/$vaila->id/edit")}}">edit</a>
                        <a href="{{url("vaila/$vaila->id/show")}}">show</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

@endsection
