@extends('layouts.app')

@section('title', strtoupper($station->name))

@section('header')
    <h1 class="page-title">{{ strtoupper($station->name) }}</h1>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-9">
            <div class="card">
                <div class="card-block">
                    <div class="row">
                        <div class="col-md-4 text-center border-right">
                            <h4 class="card-title">Phone</h4>
                            <p class="card-text">{{ $station->phone }}</p>
                            <p class="card-text">{{ $station->mobile }}</p>
                        </div>
                        <div class="col-md-4 text-center border-right">
                            <h4 class="card-title">Email</h4>
                            <p class="card-text">{{ $station->email }}</p>
                        </div>
                        <div class="col-md-4 text-center">
                            <h4 class="card-title">Status</h4>
                            @if ($station->status == 1)
                                <span class="badge badge-success">Active</span>
                            @else
                                <span class="badge badge-danger">Inactive</span>
                            @endif
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-6 text-center border-right">
                            <h4 class="card-title">Address</h4>
                            <p class="card-text">
                                {{ $station->street1 }}, {{ $station->street2 }},
                                <br>
                                {{ $station->city }}, {{ $station->state }},
                                <br>
                                {{ $station->country }}, {{ $station->zip }}
                            </p>
                            <a href="https://www.google.com/maps/search/?api=1&query={{ $station->latitude }},{{ $station->longitude }}" target="_blank" class="fa-location-arrow"></a>
                        </div>
                        <div class="col-md-6 text-center">
                            <h4 class="card-title">Blackbox Details</h4>
                            <p class="card-text"><strong>Device ID:</strong> {{ $station->device_id }}</p>
                            <p class="card-text"><strong>Device UUID:</strong> {{ $station->device_uuid }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel panel-bordered">
                <div class="panel-heading">
                    <h3 class="panel-title"><i class="icon fa-plug" aria-hidden="true"></i>Charging Pins</h3>
                </div>
                <div class="panel-body">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Battery</th>
                            <th>Type</th>
                            <th class="text-nowrap">Status</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($station->stationChargingPins as $charging_pin)
                            <tr>
                                <td>{{ $charging_pin->chargingPin->name }}</td>
                                <td>{{ $charging_pin->chargingPin->battery }}</td>
                                <td>{{ $charging_pin->chargingPin->type }}</td>
                                <td>
                                    @if ($charging_pin->status == 1)
                                        Active
                                    @else
                                        Inactive
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-block">
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <img src="{{ $station->image }}" width="100%">
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <h4 class="card-title">QR</h4>
                            <img src="{{ $station->qr_image }}">
                            <p class="card-text">{{ $station->qr_code }}</p>
                            <form method="post" action="{{ route('stations.download-qr', $station->id) }}">
                                @csrf
                                <button type="submit">Download</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
