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
            @foreach($merchants as $key=> $merchant)
                <tr>
                    <th scope="row">{{++ $key}}</th>
                    <td>{{ $merchant->name}}</td>
                    <td>{{ $merchant->email}}</td>
                    <td>{{ $merchant->phone}}</td>
                    <td>{{ \App\Helper\StatusHelper::has_attribuate($customer->status)}}</td>
                    <td> <img src="{{storage_path($merchant->avatar)}}" width="250" height="25"> </td>
                    <td>

                        <a href="{{url("merchant/$merchant->id/edit")}}">edit</a>
                        <a href="{{url("merchant/$merchant->id/show")}}">show</a>
                        <form action="{{route("merchant.destroy",$merchant->id)}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger" type="submit">Delete</button>
                        </form>

                    </td>

                </tr>
            @endforeach
            </tbody>
        </table>
        {{ $merchants->links() }}
    </div>

@endsection
