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
                <th scope="col">title english</th>
                <th scope="col">desc english</th>
                <th scope="col">arrival</th>
                <th scope="col">status</th>
                <th scope="col">has pool</th>
                <th scope="col">special</th>
                <th scope="col">has barbikio</th>
                <th scope="col">thumbnuil</th>
                <th scope="col">action</th>

            </tr>
            </thead>
            <tbody>

            @foreach($vailas as $key => $vaila)
                <tr>
                    <th scope="row">{{$key}}</th>
                    <td>{{$vaila->title_en}}</td>
                    <td>{{$vaila->desc_en}}</td>
                    <td>{{$vaila->new_arrivals ? 'new arrival': 'not new'}}</td>
                    <td>{{\App\Helper\StatusHelper::keyword_status($vaila->status)}}</td>
                    <td> {{\App\Helper\StatusHelper::has_attribuate($vaila->has_pool)}}</td>
                    <td> {{\App\Helper\StatusHelper::has_attribuate($vaila->special)}}</td>
                    <td> {{\App\Helper\StatusHelper::has_attribuate($vaila->has_barbikio)}}</td>
                    <td> <img src="{{asset($vaila->thumb)}}  " width="250" height="25"> </td>
                    <td>
                        <a  href="{{url("vaila/$vaila->id/edit")}}"><i class="fas fa-edit"></i></a>
                        
                        <a href="{{route("web.vaila.show",$vaila->id)}}"><i class="fas fa-eye"></i></a>
                        @if($vaila->active)
                             <a href="{{route("vaila.disactive",$vaila->id)}}">disactive</a>
                        @else
                            <a href="{{route("vaila.active",$vaila->id)}}">active</a>
                        @endif
                         <form action="{{route("web.vaila.destroy",$vaila->id)}}" method="POST">
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
    </div>

@endsection
