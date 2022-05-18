@extends('layouts.admin')

@section('content')

    <div class="container">
        <h1>  {{__('merchants')}}
            
        </h1>
        <a class="btn btn-secondary pull-right" href="{{url('merchant/create')}}"> {{__('create new merchant')}}</a>
        <hr />
        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">  {{__('name')}}  </th>
                <th scope="col">  {{__('email')}}  </th>
                <th scope="col"> {{__('phone')}}</th>
                <th scope="col"> {{__('status')}}</th>
                
                <th scope="col"> {{__('action')}}</th>
            </tr>
            </thead>
            <tbody>
            <?php  $i=$merchants->currentpage()*$merchants->perpage()-$merchants->perpage();?>
            @foreach($merchants as $key=> $merchant)
                <tr>
                    <th scope="row">{{++ $i}}</th>
                    <td>
                        <a href="{{url("accounting/$merchant->id")}}">{{ $merchant->name}}</a>

                    </td>
                    <td> <a href="{{url("accounting/$merchant->id")}}">{{ $merchant->email}}</a></td>
                    <td> <a href="{{url("accounting/$merchant->id")}}">{{ $merchant->phone}}</a></td>
                    <td>{{ \App\Helper\StatusHelper::keyword_status($merchant->status)}}</td>
  
                    <td>

                        <a href="{{url("merchant/$merchant->id/edit")}}"><i class="fas fa-edit"></i></a> <br/> 

                        @if($merchant->status)
                            <a href="{{route("merchant.disactive",$merchant->id)}}"><i class="fas fa-toggle-on"></i> </a><br />
                        @else
                            <a href="{{route("merchant.active",$merchant->id)}}"><i class="fas fa-toggle-off"></i> </a> <br />
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
        
        <div class="d-flex">
            {{$merchants->links('pagination::bootstrap-4')}}
        </div>
        
    </div>

@endsection
