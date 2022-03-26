@extends('layouts.admin')

@section('content')

 <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">{{ __('count order') }}</div>

                        <div class="card-body">
                            {{ $total_order }}
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">{{ __('count this month order') }}</div>

                        <div class="card-body">
                            {{ $total_order_month }}
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">{{ __('count this week order') }}</div>

                        <div class="card-body">
                            {{ $total_order_week }}
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">{{ __('count today order') }}</div>

                        <div class="card-body">
                            {{ $total_order_today }}
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
