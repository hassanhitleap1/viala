@extends('layouts.admin')

@section('content')

    <div class="container">
        <h1> merchants </h1>
        <a class="btn btn-secondary pull-right" href="{{url('merchant/create')}}"> {{__('create new merchant')}}</a>
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
                    <td>
                        <a href="{{url("accounting/$merchant->id")}}">{{ $merchant->name}}</a>

                    </td>
                    <td> <a href="{{url("accounting/$merchant->id")}}">{{ $merchant->email}}</a></td>
                    <td> <a href="{{url("accounting/$merchant->id")}}">{{ $merchant->phone}}</a></td>
                    <td>{{ \App\Helper\StatusHelper::has_attribuate($merchant->status)}}</td>
                    <td> <img src="{{asset($merchant->avatar)}}"  class="img-fluid img-thumbnail" width="250" height="25"> </td>
                    <td>

                        <a href="{{url("merchant/$merchant->id/edit")}}"><i class="fas fa-edit"></i></a>
                        <a href="{{url("merchant/$merchant->id/show")}}"><i class="fas fa-eye"></i></a>
                        @if($merchant->status)
                            <a href="{{route("merchant.disactive",$merchant->id)}}">disactive</a>
                        @else
                            <a href="{{route("merchant.active",$merchant->id)}}">active</a>
                        @endif
                        <form action="{{route("merchant.destroy",$merchant->id)}}" method="POST">
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
        {{ $merchants->links() }}
    </div>

@endsection
