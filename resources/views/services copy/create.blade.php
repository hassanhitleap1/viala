@extends('layouts.admin')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('create new slider') }}</div>

                    @if ($errors->any())
                        @foreach ($errors->all() as $error)
                            <div>{{$error}}</div>
                        @endforeach
                    @endif

                    <div class="card-body">
                        <form method="post" action="{{ url('sliders') }}" enctype="multipart/form-data">
                            @csrf


                            <div class="col-md-6 ">
                                    <div class="mb-3">
                                        <label for="formFile" class="form-label">image</label>
                                        <input class="form-control" type="file"  name="file"  >
                                    </div>
                                </div>
                          
                            
                            <div class="row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Save') }}
                                    </button>

                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
