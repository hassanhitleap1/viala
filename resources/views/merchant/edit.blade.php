@extends('layouts.admin')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('update')  }} -  {{$merchant->name}}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('merchant.update',$merchant->id) }}" enctype="multipart/form-data">
                            @csrf

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="input-group input-group-sm mb-3">
                                        <span class="input-group-text" id="inputGroup-sizing-sm">{{ __('name') }}</span>
                                        <input type="text" class="form-control" aria-label="Sizing example input" name="name"  value="{{ $merchant->name }}"  aria-describedby="inputGroup-sizing-sm">
                                        @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="input-group input-group-sm mb-3">
                                        <span class="input-group-text" id="inputGroup-sizing-sm">{{ __('email') }}</span>
                                        <input type="email" class="form-control" aria-label="Sizing example input" name="email"  value="{{ $merchant->email }}"  aria-describedby="inputGroup-sizing-sm">
                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                            </div>

                            <div class="row mb-0">
                                <div class="col-md-6">
                                    <div class="input-group input-group-sm mb-3">
                                        <span class="input-group-text" id="inputGroup-sizing-sm">{{ __('phone') }}</span>
                                        <input type="text" class="form-control" aria-label="Sizing example input" name="email"  value="{{ $merchant->phone }}"  aria-describedby="inputGroup-sizing-sm">
                                        @error('phone')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 ">
                                    <div class="mb-3">
                                        <label for="formFile" class="form-label">avatar</label>
                                        <input class="form-control" type="file"  name="avatar" id="formFile" >
                                    </div>
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
