@extends('layouts.admin')

@section('content')

    <div class="container">
        <h1> customers </h1>
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
            @foreach($customers as $key=> $customer)
                <tr>
                    <th scope="row">{{++ $key}}</th>
                    <td>{{ $customer->name}}</td>
                    <td>{{ $customer->email}}</td>
                    <td>{{ $customer->phone}}</td>
                    <td>{{ \App\Helper\StatusHelper::has_attribuate($customer->status)}}</td>
                    <td> <img src="{{storage_path($customer->avatar)}}" width="250" height="25"> </td>
                    <td>
                        <a href="{{url("customers/$customer->id/edit")}}">edit</a>
                        <a href="{{url("customers/$customer->id/show")}}">show</a>

                        <form action="{{route("customers.destroy",$customer->id)}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger" type="submit">Delete</button>
                        </form>

                    </td>

                </tr>
            @endforeach
            </tbody>
        </table>
        {{ $customers->links() }}
    </div>

@endsection
