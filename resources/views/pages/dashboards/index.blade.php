@extends('layouts.app')
@section('title', 'Home')

@section('header')
    <h1 class="page-title">Dashboard</h1>
    <div class="page-header-actions">
    </div>
@endsection

@section('content')
    <div class="row">
        
        <div class="col-xxl-3 col-lg-3 h-p50 h-only-lg-p100 h-only-xl-p100">
            <!-- Panel Overall Sales -->
            <div class="card card-shadow card-inverse bg-blue-600 white">
                <div class="card-block p-30">
                    <div class="counter counter-lg counter-inverse text-left">
                        <div class="counter-label mb-20">
                            <div>Active Promocode</div>
                        </div>
                        <div class="counter-number-group mb-15">
                            <span class="counter-number-related">#</span>
                            <span class="counter-number">111</span>
                        </div>

                    </div>
                </div>
            </div>
            <!-- End Panel Overall Sales -->
        </div>
        
        <div class="col-xxl-3 col-lg-3 h-p50 h-only-lg-p100 h-only-xl-p100">
            <!-- Panel Overall Sales -->
            <div class="card card-shadow card-inverse bg-red-600 white">
                <div class="card-block p-30">
                    <div class="counter counter-lg counter-inverse text-left">
                        <div class="counter-label mb-20">
                            <div><a href="{{ url('charging-activities?active=true') }}" class="text-white">Active Charging</a></div>
                        </div>
                        <div class="counter-number-group mb-15">
                            <span class="counter-number-related">#</span>
                            <span class="counter-number">7777</span>
                        </div>

                    </div>
                </div>
            </div>
            <!-- End Panel Overall Sales -->
        </div>
        
        <div class="col-xxl-3 col-lg-3 h-p50 h-only-lg-p100 h-only-xl-p100">
            <!-- Panel Overall Sales -->
            <div class="card card-shadow card-inverse bg-yellow-600 white">
                <div class="card-block p-30">
                    <div class="counter counter-lg counter-inverse text-left">
                        <div class="counter-label mb-20">
                            <div>Users</div>
                        </div>
                        <div class="counter-number-group mb-15">
                            <span class="counter-number-related">#</span>
                            <span class="counter-number">{{ count($customers)}}</span>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Panel Overall Sales -->
        </div>
        
        <div class="col-xxl-3 col-lg-3 h-p50 h-only-lg-p100 h-only-xl-p100">
            <!-- Panel Overall Sales -->
            <div class="card card-shadow card-inverse bg-green-600 white">
                <div class="card-block p-30">
                    <div class="counter counter-lg counter-inverse text-left">
                        <div class="counter-label mb-20">
                            <div>Charge Points</div>
                        </div>
                        <div class="counter-number-group mb-15">
                            <span class="counter-number-related">#</span>
                            <span class="counter-number">{{count($charge_points)}}</span>
                        </div>

                    </div>
                </div>
            </div>
            <!-- End Panel Overall Sales -->
        </div>
        
        <div class="col-xxl-3 col-lg-3 h-p50 h-only-lg-p100 h-only-xl-p100">
            <div class="card card-shadow card-inverse bg-blue-600 white">
                <div class="card-block p-30">
                    <div class="counter counter-lg counter-inverse text-left">
                        <div class="counter-label mb-20">
                            <div>Total Energy (KW)</div>
                        </div>
                        <div class="counter-number-group mb-15">
                            <span class="counter-number-related"></span>
                            <span class="counter-number">9889</span>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-xxl-3 col-lg-3 h-p50 h-only-lg-p100 h-only-xl-p100">
            <div class="card card-shadow card-inverse bg-yellow-600 white">
                <div class="card-block p-30">
                    <div class="counter counter-lg counter-inverse text-left">
                        <div class="counter-label mb-20">
                            <div>Total Duration</div>
                        </div>
                        <div class="counter-number-group mb-15">
                            <span class="counter-number-related"></span>
                            <span class="counter-number">878</span>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        
    </div>
    <div class="row">
        <div class="col-xl-12 col-lg-12">
            <div id="map" style="width: 100%; height: 500px;"></div>
        </div>
    </div>
@endsection
@push('scripts')
<script>

</script>
@endpush
