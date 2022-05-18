@extends('layouts.admin')
@section('content')
<div class="container">
   <div class="row justify-content-center">
      <div class="col-md-12">
         <div class="card">
            <div class="card-body">
               <form method="POST" action="{{ url('settings') }}" >
                  @csrf
                  <div class="row">
                     <div class="col-md-6">
                        <div class="input-group input-group-sm mb-3">
                           <span class="input-group-text" id="inputGroup-sizing-sm">{{ __('email') }}</span>
                           <input type="text" class="form-control @error('email') is-invalid @enderror" aria-label="Sizing example input" name="email"
                              value="{{ $settings->email }}"  aria-describedby="inputGroup-sizing-sm">
                           @error('email')
                           <span class="invalid-feedback" role="alert">
                           <strong>{{ $message }}</strong>
                           </span>
                           @enderror
                        </div>
                     </div>

                     <div class="col-md-6">
                        <div class="input-group input-group-sm mb-3">
                           <span class="input-group-text" id="inputGroup-sizing-sm">{{ __('phone') }}</span>
                           <input type="text" class="form-control @error('phone') is-invalid @enderror" aria-label="Sizing example input"
                              name="phone"  value="{{ $settings->phone }}"  aria-describedby="inputGroup-sizing-sm">
                           @error('phone')
                           <span class="invalid-feedback" role="alert">
                           <strong>{{ $message }}</strong>
                           </span>
                           @enderror
                        </div>
                     </div>
                  </div>









                  <div class="row">
                     <div class="col-md-12">
                        <div class="input-group input-group-sm mb-3">
                           <span class="input-group-text" id="inputGroup-sizing-sm">{{ __('terms and conditions english') }}</span>
                           <textarea name="terms_and_conditions_en" class="form-control  @error('terms_and_conditions_en') is-invalid @enderror"
                              rows="4" cols="50">{{ $settings->terms_and_conditions_en }}</textarea>
                           @error('terms_and_conditions_en')
                           <span class="invalid-feedback" role="alert">
                           <strong>{{ $message }}</strong>
                           </span>
                           @enderror
                        </div>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-md-12">
                        <div class="input-group input-group-sm mb-3">
                           <span class="input-group-text" id="inputGroup-sizing-sm">{{ __('terms and conditions arabic') }}</span>
                           <textarea name="terms_and_conditions_ar" class="form-control  @error('terms_and_conditions_ar') is-invalid @enderror"  rows="4" cols="50">{{ $settings->terms_and_conditions_ar }}</textarea>
                           @error('terms_and_conditions_ar')
                           <span class="invalid-feedback" role="alert">
                           <strong>{{ $message }}</strong>
                           </span>
                           @enderror
                        </div>
                     </div>
                  </div>
                


                  <div class="row">
                    <div class="col-md-12">
                        <div class="input-group input-group-sm mb-3">
                            <span class="input-group-text" id="inputGroup-sizing-sm">{{ __('privacy policy english') }}</span>
                            <textarea name="privacy_policy_en" class="form-control  @error('privacy_policy_en') is-invalid @enderror"
                            rows="4" cols="50">{{ $settings->privacy_policy_en }}</textarea>
                            @error('privacy_policy_en')
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                  </div>
                  <div class="row">
       
                    <div class="col-md-12">
                        <div class="input-group input-group-sm mb-3">
                        <span class="input-group-text" id="inputGroup-sizing-sm">{{ __('privacy policy arabic') }}</span>
                        <textarea name="privacy_policy_ar" class="form-control  @error('privacy_policy_ar') is-invalid @enderror"  rows="4" cols="50">{{ $settings->privacy_policy_ar}}</textarea>
                        @error('privacy_policy_ar')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                  </div>
         
            
    
         <div class="row"> 
   <div class="col-md-12">
   <div class="input-group input-group-sm mb-3">
   <span class="input-group-text" id="inputGroup-sizing-sm">{{ __('about english') }}</span>
   <textarea name="about_en" class="form-control  @error('about_en') is-invalid @enderror"  rows="4" cols="50">{{ $settings->about_en }}</textarea>
   @error('about_en')
   <span class="invalid-feedback" role="alert">
   <strong>{{ $message }}</strong>
   </span>
   @enderror
   </div>
   </div>
</div>
<div class="col-md-12">
<div class="input-group input-group-sm mb-3">
<span class="input-group-text" id="inputGroup-sizing-sm">{{ __('about arabic') }}</span>
<textarea name="about_ar" class="form-control  @error('about_ar') is-invalid @enderror"  rows="4" cols="50">{{ $settings->about_ar }}</textarea>
@error('about_ar')
<span class="invalid-feedback" role="alert">
<strong>{{ $message }}</strong>
</span>
@enderror
</div>
</div>
</div>
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
