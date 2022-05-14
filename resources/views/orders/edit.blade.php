@extends('layouts.admin')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('update') }}</div>

                    @if ($errors->any())
                        @foreach ($errors->all() as $error)
                            <div>{{$error}}</div>
                        @endforeach
                    @endif
                    
                    <div class="card-body">
                        <form method="post"  action="{{ route('web.orders.update',$order->id) }}" enctype="multipart/form-data">
                        @csrf
                            @method('PATCH')


                            <div class="row">
                            <div class="col-md-3">
                                    <div class="input-group input-group-sm mb-3">
                                            <span class="input-group-text" id="inputGroup-sizing-sm">{{ __('status') }}</span>
                                            <select class="form-control  @error('status') is-invalid @enderror"  name="status" aria-describedby="inputGroup-sizing-sm" >
                                            <option value="pending" @if($order->status == "pending") selected @endif>{{__("pending")}}</option>
                                            <option value="success" @if($order->status == "success" ) selected @endif>{{__("success")}}</option>
                                            </select>
                                        </div>
                                        @error('status')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
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
