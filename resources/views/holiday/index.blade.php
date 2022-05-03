@extends('layouts.admin')

@section('content')


    <div class="container">
        <h1> holidays </h1>
        <a class="btn btn-secondary pull-right" href="{{url('holiday/create')}}"> {{__('create holiday')}}</a>
        <hr />
        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col"> {{__('name')}}  </th>
                <th scope="col"> {{__('date')}}</th>
                <th scope="col"> {{__('action')}}</th>
            
            

            </tr>
            </thead>
            <tbody>

            @foreach($holidays  as $key => $holiday)
                <tr>
                    <th scope="row">{{$key}}</th>
                    <td>{{$holiday->name}}</td>
                    <td>{{$holiday->date}}</td>
                    <td>
                    <a href="{{url("holiday/$holiday->id/edit")}}"><i class="fas fa-edit"></i> </a>

                    <form action="{{route("holiday.destroy",$holiday->id)}}" method="POST">
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
