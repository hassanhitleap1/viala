@extends('layouts.admin')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('create new Services') }}</div>

                    @if ($errors->any())
                        @foreach ($errors->all() as $error)
                            <div>{{$error}}</div>
                        @endforeach
                    @endif

                    <div class="card-body">
                        <form method="post" action="{{ url('services') }}" enctype="multipart/form-data">
                            @csrf


                            <div class="row">
                                <div class="col-md-4">
                                    <div class="input-group input-group-sm mb-3">
                                        <span class="input-group-text" id="inputGroup-sizing-sm">{{ __('name_en') }}</span>
                                        <input type="text" class="form-control @error('name_en') is-invalid @enderror" aria-label="Sizing example input" name="name_en"  value="{{ old('name_en') }}"  aria-describedby="inputGroup-sizing-sm">
                                        @error('name_en')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="input-group input-group-sm mb-3">
                                        <span class="input-group-text" id="inputGroup-sizing-sm">{{ __('name_ar') }}</span>
                                        <input type="text" class="form-control @error('name_ar') is-invalid @enderror" aria-label="Sizing example input" name="name_ar"  value="{{ old('name_ar') }}"  aria-describedby="inputGroup-sizing-sm">
                                        @error('name_ar')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="input-group input-group-sm mb-3">
                                        <span class="input-group-text" id="inputGroup-sizing-sm">{{ __('name_he') }}</span>
                                        <input type="text" class="form-control @error('name_he') is-invalid @enderror" aria-label="Sizing example input" name="name_he"  value="{{ old('name_he') }}"  aria-describedby="inputGroup-sizing-sm">
                                        @error('name_he')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="form-check form-switch">
                                    <input class="form-check-input"  name="is_main"  @if(old('is_main'))  checked @endif   type="checkbox" id="flexSwitchCheckDefault">
                                    <label class="form-check-label"  for="flexSwitchCheckDefault">{{__('is_main')}}</label>
                                </div>


                                <div class="col-md-6 ">
                                    <div class="mb-3">
                                        <label for="formFile" class="form-label">thumb</label>
                                        <input class="form-control" type="file"  name="file"  >
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
