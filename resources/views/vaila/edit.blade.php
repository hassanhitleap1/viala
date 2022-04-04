@extends('layouts.admin')

@section('content')


    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('create new viala') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ url('vaila',$vaila->id) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="input-group input-group-sm mb-3">
                                        <span class="input-group-text" id="inputGroup-sizing-sm">{{ __('title') }}</span>
                                        <input type="text" class="form-control @error('title') is-invalid @enderror" aria-label="Sizing example input" name="title"  value="{{ $vaila->title }}"  aria-describedby="inputGroup-sizing-sm">
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
                                        <textarea name="desc" class="form-control  @error('desc') is-invalid @enderror"  rows="4" cols="50">
                                                {{ $vaila->desc }}
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
                                        <input type="number" class="form-control @error('price') is-invalid @enderror" name="price" aria-label="Sizing example input" value="{{ $vaila->price }}" aria-describedby="inputGroup-sizing-sm">
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
                                        <input type="number"  name="price_weekend"  class="form-control @error('price_weekend') is-invalid @enderror" aria-label="Sizing example input"  value="{{ $vaila->price_weekend }}" aria-describedby="inputGroup-sizing-sm">
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
                                        <input type="number"  name="price_hoolday"  class="form-control @error('price_hoolday') is-invalid @enderror" aria-label="Sizing example input"  value="{{ $vaila->price_hoolday }}" aria-describedby="inputGroup-sizing-sm">
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
                                        <input type="number" class="form-control  @error('number_room') is-invalid @enderror" name="number_room" aria-label="Sizing example input" value="{{ $vaila->number_room }}" aria-describedby="inputGroup-sizing-sm">
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
                                        <select class="form-control  @error('governorate_id') is-invalid @enderror"  name="governorate_id" aria-describedby="inputGroup-sizing-sm" >
                                            <option value="">--</option>
                                            @foreach($governorates as $governorate)
                                                <option value="{{$governorate->id}}" @if($vaila->governorate_id == $governorate->id ) selected @endif >{{$governorate->name_ar}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('governorate_id')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input"  name="special"  @if($vaila->special)  checked @endif   type="checkbox" id="flexSwitchCheckDefault">
                                        <label class="form-check-label"  for="flexSwitchCheckDefault">{{__('special')}}</label>
                                    </div>

                                    <div class="form-check form-switch">
                                        <input class="form-check-input"  name="new_arrivals"  @if($vaila->new_arrivals)  checked @endif   type="checkbox" id="flexSwitchCheckDefault">
                                        <label class="form-check-label"  for="flexSwitchCheckDefault">{{__('new arrivals')}}</label>
                                    </div>


                                    <div class="form-check form-switch">
                                        <input class="form-check-input" name="has_pool"  @if($vaila->has_pool)  checked @endif    type="checkbox" id="flexSwitchCheckDefault">
                                        <label class="form-check-label"  for="flexSwitchCheckDefault">{{__('has pool')}}</label>
                                    </div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" name="has_barbikio"  @if($vaila->has_barbikio)  checked @endif  type="checkbox" id="flexSwitchCheckDefault">
                                        <label class="form-check-label"  for="flexSwitchCheckDefault">{{__('has barbikio')}}</label>
                                    </div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" name="has_parcking"  @if($vaila->has_parcking)  checked @endif  type="checkbox" id="flexSwitchCheckDefault">
                                        <label class="form-check-label" for="flexSwitchCheckDefault">{{__('has parcking')}}</label>
                                    </div>

                                </div>


                                <div class="col-md-6">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" name="garden"  @if($vaila->garden)  checked @endif type="checkbox" id="flexSwitchCheckDefault">
                                        <label class="form-check-label"  for="flexSwitchCheckDefault">{{__('garden')}}</label>
                                    </div>

                                    <div class="form-check form-switch">
                                        <input class="form-check-input" name="conditioners"  @if($vaila->conditioners)  checked @endif  type="checkbox" id="flexSwitchCheckDefault">
                                        <label class="form-check-label"  for="flexSwitchCheckDefault">{{__('conditioners')}}</label>
                                    </div>


                                    <div class="form-check form-switch">
                                        <input class="form-check-input" name="kitchen"  @if($vaila->kitchen)  checked @endif  type="checkbox" id="flexSwitchCheckDefault">
                                        <label class="form-check-label"  for="flexSwitchCheckDefault">{{__('kitchen')}}</label>
                                    </div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" name="wifi"  @if($vaila->wifi)  checked @endif  type="checkbox" id="flexSwitchCheckDefault">
                                        <label class="form-check-label"  for="flexSwitchCheckDefault">{{__('wifi')}}</label>
                                    </div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" name="for_shbab"  @if($vaila->for_shbab)  checked @endif  type="checkbox" id="flexSwitchCheckDefault">
                                        <label class="form-check-label"  for="flexSwitchCheckDefault">{{__('for shbab')}}</label>
                                    </div>

                                </div>


                            </div>
                            <div class="row mb-0">
                                <div class="col-md-6 ">
                                    <div class="mb-3">
                                        <label for="formFile" class="form-label">thumb</label>
                                        <input class="form-control" type="file"  name="thumb" id="formFile" >
                                    </div>
                                </div>

                                <div class="col-md-6 ">
                                    <div class="mb-3">
                                        <label for="formFile" class="form-label">images</label>
                                        <input class="form-control" type="file"  name="images"  multiple>

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
