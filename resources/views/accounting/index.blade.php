@extends('layouts.admin')

@section('content')

 <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">{{ __('for me') }}</div>

                        <div class="card-body">
                            {{ $for_me }}
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">{{ __('for app') }}</div>

                        <div class="card-body">
                             {{ $for_app }}
                        </div>
                    </div>
                </div>
          
            </div>
            <div class="row justify-content-center mt-5">
            <form action="{{route("accounting.delete",$merchant->id)}}" method="POST">
                            @csrf
                            @method('DELETE')
                             <button type="submit" title="delete" class="btn" style="border: none; background-color:transparent;">
                                 <i class="fas fa-trash fa-lg text-danger"></i> تصفير
                             </button>
            </form>
            </div>
        </div>

@endsection
