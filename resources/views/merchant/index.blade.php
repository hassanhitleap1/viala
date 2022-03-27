@extends('layouts.admin')

@section('content')

    <div class="container">
        <h1> merchants </h1>
        <hr />
        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">name</th>
                <th scope="col">email</th>
                <th scope="col">phone</th>
                <th scope="col">status</th>
                <th scope="col">avatar</th>
                <th scope="col">action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($customers as $key=> $merchant)
                <tr>
                    <th scope="row">{{++ $key}}</th>
                    <td>{{ $merchant->name}}</td>
                    <td>{{ $merchant->email}}</td>
                    <td>{{ $merchant->phone}}</td>
                    <td>{{ \App\Helper\StatusHelper::has_attribuate($customer->status)}}</td>
                    <td>
                        <a href="{{url("merchant/$merchant->id/edit")}}">edit</a>
                        <a href="{{url("merchant/$merchant->id/show")}}">show</a>
                    </td>

                </tr>
            @endforeach
            </tbody>
        </table>
        {{ $customers->links() }}
    </div>

@endsection
