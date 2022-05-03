@extends('layouts.admin')

@section('content')

    <div class="container">
        <h1> orders </h1>
        <hr />
        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">{{__('form date')}} </th>
                <th scope="col">{{__('to date')}}</th>
                <th scope="col"> {{__('price')}}</th>
                <th scope="col"> {{__('payment type')}}</th>
                <th scope="col"> {{__('vaila')}}</th>

            </tr>
            </thead>
            <tbody>
            @foreach($orders as $key => $order)
                <tr>
                <th scope="row">{{++$key}}</th>
                <td>{{$order->form_date}}</td>
                    <td>{{$order->form_date}}</td>
                    <td>{{$order->price}}</td>
                    <td>{{$order->payment_type}}</td>
                    <td>{{is_null($order['vaila'])?'':$order['vaila']['title']}}</td>
            </tr>
            @endforeach

            </tbody>
        </table>
 
        <div class="d-flex">
            {{$orders->links('pagination::bootstrap-4')}}
        </div>
        
    </div>
      

@endsection
