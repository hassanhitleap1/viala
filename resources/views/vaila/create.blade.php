@extends('layouts.admin')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('create new viala') }}</div>

                    <div class="card-body">
                        <form method="post" action="{{ url('vaila') }}" enctype="multipart/form-data">
                            @csrf


                            <div class="row">
                                <div class="col-md-6">
                                    <div class="input-group input-group-sm mb-3">
                                        <span class="input-group-text" id="inputGroup-sizing-sm">{{ __('title') }}</span>
                                        <input type="text" class="form-control" aria-label="Sizing example input" name="title"  value="{{ old('title') }}"  aria-describedby="inputGroup-sizing-sm">
                                        @error('title')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="input-group input-group-sm mb-3">
                                        <span class="input-group-text" id="inputGroup-sizing-sm">{{ __('desc') }}</span>
                                        <textarea name="desc" class="form-control  @error('email') is-invalid @enderror" value="{{ old('desc') }}" rows="4" cols="50">
                                                {{ old('desc') }}
                                        </textarea>

                                        @error('desc')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">



                                <div class="col-md-4">
                                    <div class="input-group input-group-sm mb-3">
                                        <span class="input-group-text" id="inputGroup-sizing-sm">{{ __('price') }}</span>
                                        <input type="text" class="form-control @error('price') is-invalid @enderror" name="price" aria-label="Sizing example input" value="{{ old('price') }}" aria-describedby="inputGroup-sizing-sm">
                                    </div>
                                    @error('price')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    <div class="input-group input-group-sm mb-3">
                                        <span class="input-group-text" id="inputGroup-sizing-sm">{{ __('price weekend') }}</span>
                                        <input type="text"  name="price_weekend"  class="form-control @error('price_weekend') is-invalid @enderror" aria-label="Sizing example input"  value="{{ old('price_weekend') }}" aria-describedby="inputGroup-sizing-sm">
                                    </div>
                                    @error('price_weekend')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    <div class="input-group input-group-sm mb-3">
                                        <span class="input-group-text" id="inputGroup-sizing-sm">{{ __('price hoolday') }}</span>
                                        <input type="text"  name="price_hoolday"  class="form-control @error('price_hoolday') is-invalid @enderror" aria-label="Sizing example input"  value="{{ old('price_hoolday') }}" aria-describedby="inputGroup-sizing-sm">
                                    </div>
                                    @error('price_hoolday')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>



                            <div class="row">
                                <div class="col-md-6">
                                    <div class="input-group input-group-sm mb-3">
                                        <span class="input-group-text" id="inputGroup-sizing-sm">{{ __('number room') }}</span>
                                        <input type="number" class="form-control  @error('number_room') is-invalid @enderror" name="number_room" aria-label="Sizing example input" value="{{ old('number_room') }}" aria-describedby="inputGroup-sizing-sm">
                                    </div>
                                    @error('number_room')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <div class="input-group input-group-sm mb-3">
                                        <span class="input-group-text" id="inputGroup-sizing-sm">{{ __('reagin') }}</span>
                                        <input type="number" class="form-control  @error('reagin_id') is-invalid @enderror" name="reagin_id" aria-label="Sizing example input" value="{{ old('number_room') }}" aria-describedby="inputGroup-sizing-sm">
                                    </div>
                                    @error('reagin_id')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                            <label class="form-check-label"  name="special" for="flexSwitchCheckDefault">{{__('special')}}</label>
                                        </div>

                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                        <label class="form-check-label"  name="new_arrivals" for="flexSwitchCheckDefault">{{__('new arrivals')}}</label>
                                    </div>


                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                        <label class="form-check-label"  name="has_pool" for="flexSwitchCheckDefault">{{__('has pool')}}</label>
                                    </div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                        <label class="form-check-label"  name="has_barbikio" for="flexSwitchCheckDefault">{{__('has barbikio')}}</label>
                                    </div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                        <label class="form-check-label"  name="has_parcking" for="flexSwitchCheckDefault">{{__('has parcking')}}</label>
                                    </div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                        <label class="form-check-label"  name="for_shbab" for="flexSwitchCheckDefault">{{__('for shbab')}}</label>
                                    </div>
                                </div>


                                <div class="col-md-6">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                        <label class="form-check-label"  name="garden" for="flexSwitchCheckDefault">{{__('garden')}}</label>
                                    </div>

                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                        <label class="form-check-label"  name="conditioners" for="flexSwitchCheckDefault">{{__('conditioners')}}</label>
                                    </div>


                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                        <label class="form-check-label"  name="kitchen" for="flexSwitchCheckDefault">{{__('kitchen')}}</label>
                                    </div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                        <label class="form-check-label"  name="wifi" for="flexSwitchCheckDefault">{{__('wifi')}}</label>
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
