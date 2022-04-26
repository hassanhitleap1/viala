@extends('layouts.admin')

@section('content')


    <div class="container">
        <h1> slider </h1>
        <a class="btn btn-secondary pull-right" href="{{url('sliders/create')}}"> {{__('create new slider')}}</a>
        <hr />
        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">image path</th>
               
            

            </tr>
            </thead>
            <tbody>

            @foreach($sliders  as $key => $slider)
                <tr>
                    <th scope="row">{{$key}}</th>
                    <td> <img src="{{asset($slider->path)}}  " width="250" height="250"> </td>
                    <td>
                    <td>
                     
                         <form action="{{route("sliders.destroy",$slider->id)}}" method="POST">
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
