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


                            
                            <div  class="row">
                                <div class="col-md-3">
                                    <div class="input-group input-group-sm mb-3">
                                        <span class="input-group-text" id="inputGroup-sizing-sm">{{ __('code') }}</span>
                                        <input type="text" class="form-control @error('code') is-invalid @enderror" aria-label="Sizing example input" name="code"  value="{{ $vaila->code}}"  aria-describedby="inputGroup-sizing-sm">
                                        @error('code')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>


                                <div class="col-md-3">
                                    <div class="input-group input-group-sm mb-3">
                                        <span class="input-group-text" id="inputGroup-sizing-sm">{{ __('entry hour') }}</span>
                                        <input type="time" class="form-control @error('entry_hour') is-invalid @enderror" aria-label="Sizing example input" name="entry_hour"  value="{{ $vaila->entry_hour}}"  aria-describedby="inputGroup-sizing-sm">
                                        @error('entry_hour')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>


                                <div class="col-md-3">
                                    <div class="input-group input-group-sm mb-3">
                                        <span class="input-group-text" id="inputGroup-sizing-sm">{{ __('out hour') }}</span>
                                        <input type="time" class="form-control @error('out_hour') is-invalid @enderror" aria-label="Sizing example input" name="out_hour"  value="{{ $vaila->out_hour}}"  aria-describedby="inputGroup-sizing-sm">
                                        @error('out_hour')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="input-group input-group-sm mb-3">
                                            <span class="input-group-text" id="inputGroup-sizing-sm">{{ __('marchant') }}</span>
                                            <select class="form-control  @error('user_id') is-invalid @enderror"  name="user_id" aria-describedby="inputGroup-sizing-sm" >
                                                @foreach($users as $user)
                                                    <option value="{{$user->id}}" @if($vaila->user_id == $user->id ) selected @endif>{{$user->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        @error('user_id')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            </div>


                            <div class="row">
                                <div class="col-md-6">
                                    <div class="input-group input-group-sm mb-3">
                                        <span class="input-group-text" id="inputGroup-sizing-sm">{{ __('title english') }}</span>
                                        <input type="text" class="form-control @error('title_en') is-invalid @enderror" aria-label="Sizing example input" name="title_en"  value="{{ $vaila->title_en }}"  aria-describedby="inputGroup-sizing-sm">
                                        @error('title_en')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="input-group input-group-sm mb-3">
                                        <span class="input-group-text" id="inputGroup-sizing-sm">{{ __('desc english') }}</span>
                                        <textarea name="desc_en" class="form-control  @error('desc_en') is-invalid @enderror"  rows="4" cols="50">
                                                {{ $vaila->desc_en }}
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
                                <div class="col-md-6">
                                    <div class="input-group input-group-sm mb-3">
                                        <span class="input-group-text" id="inputGroup-sizing-sm">{{ __('title arabic') }}</span>
                                        <input type="text" class="form-control @error('title_ar') is-invalid @enderror" aria-label="Sizing example input" name="title_ar"  value="{{ $vaila->title_ar }}"  aria-describedby="inputGroup-sizing-sm">
                                        @error('title_ar')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="input-group input-group-sm mb-3">
                                        <span class="input-group-text" id="inputGroup-sizing-sm">{{ __('desc arabic') }}</span>
                                        <textarea name="desc_ar" class="form-control  @error('desc_ar') is-invalid @enderror"  rows="4" cols="50">
                                                {{ $vaila->desc_ar }}
                                        </textarea>

                                        @error('desc_ar')
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

                                <div class="col-md-3">
                                    <div class="input-group input-group-sm mb-3">
                                        <span class="input-group-text" id="inputGroup-sizing-sm">{{ __('price weddings') }}</span>
                                        <input type="number" class="form-control @error('price_weddings') is-invalid @enderror" name="price_weddings" aria-label="Sizing example input" value="{{ $vaila->price_weddings }}" aria-describedby="inputGroup-sizing-sm">
                                    </div>
                                    @error('price_weddings')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    <div class="input-group input-group-sm mb-3">
                                        <span class="input-group-text" id="inputGroup-sizing-sm">{{ __('area') }}</span>
                                        <input type="number"  name="area"  class="form-control @error('area') is-invalid @enderror" aria-label="Sizing example input"  value="{{ $vaila->area }}" aria-describedby="inputGroup-sizing-sm">
                                    </div>
                                    @error('area')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="col-md-4">
                                    <div class="input-group input-group-sm mb-3">
                                        <span class="input-group-text" id="inputGroup-sizing-sm">{{ __('insurance amount') }}</span>
                                        <input type="number"  name="insurance_amount"  class="form-control @error('insurance_amount') is-invalid @enderror" aria-label="Sizing example input"  value="{{ $vaila->insurance_amount }}" aria-describedby="inputGroup-sizing-sm">
                                    </div>
                                    @error('insurance_amount')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>


                                
                                <div class="col-md-4">
                                    <div class="input-group input-group-sm mb-3">
                                        <span class="input-group-text" id="inputGroup-sizing-sm">{{ __('retainer') }}</span>
                                        <input type="number"  name="retainer"  class="form-control @error('retainer') is-invalid @enderror" aria-label="Sizing example input"  value="{{ $vaila->retainer }}" aria-describedby="inputGroup-sizing-sm">
                                    </div>
                                    @error('retainer')
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
                                        <input class="form-check-input"  name="weddings"  @if($vaila->weddings)  checked @endif   type="checkbox" id="flexSwitchCheckDefault">
                                        <label class="form-check-label"  for="flexSwitchCheckDefault">{{__('weddings')}}</label>
                                    </div>

                                    <div class="form-check form-switch">
                                        <input class="form-check-input"  name="new_arrivals"  @if($vaila->new_arrivals)  checked @endif   type="checkbox" id="flexSwitchCheckDefault">
                                        <label class="form-check-label"  for="flexSwitchCheckDefault">{{__('new arrivals')}}</label>
                                    </div>

                                    <div class="form-check form-switch">
                                        <input class="form-check-input" name="for_shbab"  @if($vaila->for_shbab)  checked @endif  type="checkbox" id="flexSwitchCheckDefault">
                                        <label class="form-check-label"  for="flexSwitchCheckDefault">{{__('for shbab')}}</label>
                                    </div>
                                </div>



                            </div>

                            <hr/>

                          
                            <h1>{{__('services')}}</h1>
                            <div class="row">
                                @foreach($services as $service)
                                    <div class="col-md-3">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input"  name="services[{{$service->id}}]"  @if( in_array($service->id, $selected_services))  checked @endif     type="checkbox" id="{{$service->id}}">
                                            <label class="form-check-label"  for="{{$service->id}}">{{ $service->name_ar}}</label>
                                        </div>
                                    
                                    </div>
                                @endforeach
                            
                            </div>
                            <div class="row mb-0">
                                <div class="col-md-6 ">
                                    <div class="mb-3">
                                        <label for="formFile" class="form-label">{{__('thumb')}}</label>
                                        <input class="form-control" type="file"  name="thumb" id="formFile" >
                                    </div>
                                </div>

                                <div class="col-md-6 ">
                                    <div class="mb-3">
                                        <label for="formFile" class="form-label">{{__('images')}}</label>
                                        <input class="form-control"  type="file"  name="images[]" multiple>
                                        

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
