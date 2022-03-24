@extends('layouts.admin')

@section('content')

 <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">{{ __('count order') }}</div>

                        <div class="card-body">
                            {{ $orders_count }}
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">{{ __('count user') }}</div>

                        <div class="card-body">
                            {{ $user_count }}
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">{{ __('count marchant') }}</div>

                        <div class="card-body">
                            {{ $marchant_counr }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

@endsection
