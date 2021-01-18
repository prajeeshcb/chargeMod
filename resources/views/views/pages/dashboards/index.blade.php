@extends('layouts.app')
@section('title', 'Home')

@section('header')
    <h1 class="page-title">Dashboard</h1>
    <div class="page-header-actions">
    </div>
@endsection

@section('content')
    <div class="row">
        @canany(['can'], \App\Models\Admin::class)
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
                            <span class="counter-number">{{ $promocodes }}</span>
                        </div>

                    </div>
                </div>
            </div>
            <!-- End Panel Overall Sales -->
        </div>
        @endcanany
        @canany(['can', 'workPlaceManager'], \App\Models\Admin::class)
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
                            <span class="counter-number">{{ $active_charging }}</span>
                        </div>

                    </div>
                </div>
            </div>
            <!-- End Panel Overall Sales -->
        </div>
        @endcanany
        @canany(['can'], \App\Models\Admin::class)
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
                            <span class="counter-number">{{ $users }}</span>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Panel Overall Sales -->
        </div>
        @endcanany
        @canany(['can', 'workPlaceManager'], \App\Models\Admin::class)
        <div class="col-xxl-3 col-lg-3 h-p50 h-only-lg-p100 h-only-xl-p100">
            <!-- Panel Overall Sales -->
            <div class="card card-shadow card-inverse bg-green-600 white">
                <div class="card-block p-30">
                    <div class="counter counter-lg counter-inverse text-left">
                        <div class="counter-label mb-20">
                            <div>Stations</div>
                        </div>
                        <div class="counter-number-group mb-15">
                            <span class="counter-number-related">#</span>
                            <span class="counter-number">{{ count($stations) }}</span>
                        </div>

                    </div>
                </div>
            </div>
            <!-- End Panel Overall Sales -->
        </div>
        @endcanany
        @canany(['workPlaceManager'], \App\Models\Admin::class)
        <div class="col-xxl-3 col-lg-3 h-p50 h-only-lg-p100 h-only-xl-p100">
            <div class="card card-shadow card-inverse bg-blue-600 white">
                <div class="card-block p-30">
                    <div class="counter counter-lg counter-inverse text-left">
                        <div class="counter-label mb-20">
                            <div>Total Energy (KW)</div>
                        </div>
                        <div class="counter-number-group mb-15">
                            <span class="counter-number-related"></span>
                            <span class="counter-number">{{ $totalEnergy }}</span>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        @endcanany
        @canany(['workPlaceManager'], \App\Models\Admin::class)
        <div class="col-xxl-3 col-lg-3 h-p50 h-only-lg-p100 h-only-xl-p100">
            <div class="card card-shadow card-inverse bg-yellow-600 white">
                <div class="card-block p-30">
                    <div class="counter counter-lg counter-inverse text-left">
                        <div class="counter-label mb-20">
                            <div>Total Duration</div>
                        </div>
                        <div class="counter-number-group mb-15">
                            <span class="counter-number-related"></span>
                            <span class="counter-number">{{ $totalDuration }}</span>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        @endcanany
    </div>
    <div class="row">
        <div class="col-xl-12 col-lg-12">
            <div id="map" style="width: 100%; height: 500px;"></div>
        </div>
    </div>
@endsection
@push('scripts')
<script>
    function initMap() {
        var locations = [
                @foreach($stations as $station)
                    ['{{ $station->name }}', {{ $station->latitude }}, {{ $station->longitude }}],
                @endforeach
        ];

        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 10,
            center: new google.maps.LatLng(11.25, 75.78),
            mapTypeId: google.maps.MapTypeId.ROADMAP,
            styles: [
                {
                    "elementType": "geometry",
                    "stylers": [
                        {
                            "color": "#f5f5f5"
                        }
                    ]
                },
                {
                    "elementType": "labels.icon",
                    "stylers": [
                        {
                            "visibility": "off"
                        }
                    ]
                },
                {
                    "elementType": "labels.text.fill",
                    "stylers": [
                        {
                            "color": "#616161"
                        }
                    ]
                },
                {
                    "elementType": "labels.text.stroke",
                    "stylers": [
                        {
                            "color": "#f5f5f5"
                        }
                    ]
                },
                {
                    "featureType": "administrative.land_parcel",
                    "elementType": "labels.text.fill",
                    "stylers": [
                        {
                            "color": "#bdbdbd"
                        }
                    ]
                },
                {
                    "featureType": "poi",
                    "elementType": "geometry",
                    "stylers": [
                        {
                            "color": "#eeeeee"
                        }
                    ]
                },
                {
                    "featureType": "poi",
                    "elementType": "labels.text.fill",
                    "stylers": [
                        {
                            "color": "#757575"
                        }
                    ]
                },
                {
                    "featureType": "poi.park",
                    "elementType": "geometry",
                    "stylers": [
                        {
                            "color": "#e5e5e5"
                        }
                    ]
                },
                {
                    "featureType": "poi.park",
                    "elementType": "labels.text.fill",
                    "stylers": [
                        {
                            "color": "#9e9e9e"
                        }
                    ]
                },
                {
                    "featureType": "road",
                    "elementType": "geometry",
                    "stylers": [
                        {
                            "color": "#ffffff"
                        }
                    ]
                },
                {
                    "featureType": "road.arterial",
                    "elementType": "labels.text.fill",
                    "stylers": [
                        {
                            "color": "#757575"
                        }
                    ]
                },
                {
                    "featureType": "road.highway",
                    "elementType": "geometry",
                    "stylers": [
                        {
                            "color": "#dadada"
                        }
                    ]
                },
                {
                    "featureType": "road.highway",
                    "elementType": "labels.text.fill",
                    "stylers": [
                        {
                            "color": "#616161"
                        }
                    ]
                },
                {
                    "featureType": "road.local",
                    "elementType": "labels.text.fill",
                    "stylers": [
                        {
                            "color": "#9e9e9e"
                        }
                    ]
                },
                {
                    "featureType": "transit.line",
                    "elementType": "geometry",
                    "stylers": [
                        {
                            "color": "#e5e5e5"
                        }
                    ]
                },
                {
                    "featureType": "transit.station",
                    "elementType": "geometry",
                    "stylers": [
                        {
                            "color": "#eeeeee"
                        }
                    ]
                },
                {
                    "featureType": "water",
                    "elementType": "geometry",
                    "stylers": [
                        {
                            "color": "#c9c9c9"
                        }
                    ]
                },
                {
                    "featureType": "water",
                    "elementType": "labels.text.fill",
                    "stylers": [
                        {
                            "color": "#9e9e9e"
                        }
                    ]
                }
            ]
        });

        var infowindow = new google.maps.InfoWindow();

        var marker, i;

        for (i = 0; i < locations.length; i++) {
            marker = new google.maps.Marker({
                position: new google.maps.LatLng(locations[i][1], locations[i][2]),
                map: map
            });

            google.maps.event.addListener(marker, 'click', (function(marker, i) {
                return function() {
                    infowindow.setContent(locations[i][0]);
                    infowindow.open(map, marker);
                }
            })(marker, i));
        }
    }
</script>
@endpush
