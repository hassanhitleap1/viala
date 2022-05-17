@extends('layouts.admin')

@section('content')


    <div class="container">
     
        <a class="btn btn-secondary pull-right" href="{{url('vaila/create')}}"> {{__('create new vaila')}}</a>
        <hr />
        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">  {{__('title arabic')}}</th>
                <th scope="col">  {{__('desc arabic')}}</th>
                <th scope="col">  {{__('status')}}</th>
                <th scope="col"> {{__('thumbnuil')}} </th>
                <th scope="col">  {{__('action')}}</th>

            </tr>
            </thead>
            <tbody>
               
            <?php  $i=$vailas->currentpage()*$vailas->perpage()-$vailas->perpage();?>
            @foreach($vailas as $key => $vaila)
                <tr>
                    <th scope="row">{{++$i}}</th>
                    <td>{{$vaila->title_ar}}</td>
                    <td>{{$vaila->desc_ar}}</td>
             
                    <td>{{\App\Helper\StatusHelper::keyword_status($vaila->active)}}</td>
                    <td class="w-25" >  <img  class="img-fluid img-thumbnail" src="{{asset($vaila->thumb)}}  " width="250" height="20"> </td>
                    <td>
                        <a  href="{{url("vaila/$vaila->id/edit")}}"><i class="fas fa-edit"></i></a><br />
                        
                        <a href="{{route("web.vaila.show",$vaila->id)}}"><i class="fas fa-eye"></i></a><br />
                        @if($vaila->active)
                             <a href="{{route("vaila.disactive",$vaila->id)}}"> <i class="fas fa-toggle-on"></i> </a><br />
                        @else
                            <a href="{{route("vaila.active",$vaila->id)}}"> <i class="fas fa-toggle-off"></i> </a><br />
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

        <div class="d-flex">
            {{$vailas->links('pagination::bootstrap-4')}}
        </div>
    </div>

@endsection
