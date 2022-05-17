@extends('layouts.admin')

@section('content')

    <div class="container">
        <h1> {{__('orders')}} </h1>
        <hr />
        <form action="{{url('orders')}}" method="get">
            
            <div class="row">
                           
            <div class="col-md-3">
                                        <div class="input-group input-group-sm mb-3">
                                            <span class="input-group-text" id="inputGroup-sizing-sm">{{ __('status') }}</span>
                                            <select class="form-control  @error('status') is-invalid @enderror"  name="status" aria-describedby="inputGroup-sizing-sm" >
                                            <option value="pending" @if(isset($_GET['status']) && $_GET['status'] == "pending") selected @endif>{{__("pending")}}</option>
                                            <option value="success" @if(isset($_GET['status']) && $_GET['status']== "success" ) selected @endif>{{__("success")}}</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('search') }}
                                    </button>

                                </div>
                            </div>
        </div>
        </form>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">{{__('form date')}} </th>
                <th scope="col">{{__('to date')}}</th>
                <th scope="col"> {{__('price')}}</th>
                <th scope="col"> {{__('payment type')}}</th>
                <th scope="col"> {{__('status')}}</th>
                <th scope="col"> {{__('vaila')}}</th>
                <th scope="col"> {{__('action')}}</th>

            </tr>
            </thead>
            <tbody>
            <?php  $i=$orders->currentpage()*$orders->perpage()-$orders->perpage();?>
            @foreach($orders as $key => $order)
                <tr>
                <th scope="row">{{++$i}}</th>
                <td>{{date("Y-m-d", strtotime( $order->form_date)) }}</td>
                    <td>{{ date("Y-m-d", strtotime( $order->to_date)) }}</td>
                    <td>{{$order->price}}</td>
                    <td>{{__($order->payment_type)}}</td>
                    <td>{{__($order->status)}}</td>

                    <td> 

                        @if(!is_null($order['vaila']))
                        
                        <a href="{{route("web.vaila.show",$order['vaila']['id'])}}">
                            {{$order['vaila']['title_ar']}} 
                        </a>
                        @endif
                        </td>
                    <td>
                    <a href="{{url("orders/$order->id/edit")}}"><i class="fas fa-edit"></i> </a>

                    </td>
            </tr>
            @endforeach

            </tbody>
        </table>
 
        <div class="d-flex">
            {{$orders->links('pagination::bootstrap-4')}}
        </div>
        
    </div>
      

@endsection
