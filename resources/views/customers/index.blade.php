@extends('layouts.admin')

@section('content')

    <div class="container">
        <h1> customers </h1>
        <a class="btn btn-secondary pull-right" href="{{url('customers/create')}}"> {{__('create new customer')}}</a>
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
                    <td> <img src="{{asset($customer->avatar)}}" width="250" height="25"> </td>
                    <td>
                        <a href="{{url("customers/$customer->id/edit")}}"><i class="fas fa-edit"></i></a>
                        

                        @if($customer->status)
                            <a href="{{route("customers.disactive",$customer->id)}}">disactive</a>
                        @else
                            <a href="{{route("customers.active",$customer->id)}}">active</a>
                        @endif

                        <form action="{{route("customers.destroy",$customer->id)}}" method="POST">
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
        {{ $customers->links() }}
    </div>

@endsection
