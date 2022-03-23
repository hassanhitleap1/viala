@extends('layouts.admin')

@section('content')

    <div class="container">
        <h1> orders </h1>
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
            @foreach($orders as $order)
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
