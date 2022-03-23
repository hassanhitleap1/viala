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
                <th scope="col">First</th>
                <th scope="col">Last</th>
                <th scope="col">Handle</th>
            </tr>
            </thead>
            <tbody>

            @foreach($vailas as $vaila)
                <tr>
                    <th scope="row">1</th>
                    <td>Mark</td>
                    <td>Otto</td>
                    <td>@mdo</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

@endsection
