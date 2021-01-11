@extends('layouts.app')
@section('title', 'Chargepoint')

@section('header')
    <h1 class="page-title">Chargepoints</h1>
    <div class="page-header-actions">
        <a class="btn btn-sm btn-primary btn-round" href="{{ url('/addCP') }}">
            <i class="icon fa-plus" aria-hidden="true"></i>
            <span class="text hidden-sm-down">Add Chargepoint</span>
        </a>
    </div>
@endsection
@section('content')
@csrf
<div class="row">
    <div class="col-12">
        <div class="panel">
            <div class="panel-body">
                <table class="table table-hover dataTable table-striped w-full" data-plugin="dataTable">
                    <thead class="thead-dark">
                        <tr>
                            <th>ChargingPoint ID</th>
                            <th>ChargingPoint Name</th>
                            <th>ChargingPoint State</th>
                            <th>ChargingPoint District</th>
                            <th>ChargingPoint Location</th>
                            <th>ChargingPoint Connector Type</th>
                            <th>ChargeBox Serial No</th>
                            <th>ChargingPoint Serial No</th>
                            <th>ChargingPoint Firmware Version</th>
                            <th>ChargingPoint Meter Serial-No</th>
                            <th>ChargingPoint Meter Type</th>
                            <th>Station Phone</th>
                            <th>Station Email</th>
                            <th>ChargingPoint Status</th>
                            <th colspan="2">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data as $key => $value)
                        <tr>
                            <td>{{$value->CP_ID}}</td>
                            <td>{{ $value->CP_Name}}</td>
                            <td>{{ $value->CP_State}}</td>
                            <td>{{$value->CP_District}}</td>
                            <td>{{$value->CP_Loc}}</td>
                            <td>{{$value->CP_Connector_Type}}</td>
                            <td>{{$value->CB_Serial_No}}</td>
                            <td>{{$value->CP_Serial_No}}</td>
                            <td>{{$value->CP_Firmware_Ver}}</td>
                            <td>{{$value->CP_Meter_Serial_No}}</td>
                            <td>{{$value->CP_Meter_Type}}</td>
                            <td>{{$value->Station_Phone}}</td>
                            <td>{{$value->Station_Email}}</td>
                            <td>{{$value->CP_Status}}</td>
                            <td><a href="/CP/edit/{{ $value->CP_ID }}">Edit</a></td>
                            <td><a href="/CP/delete/{{ $value->CP_ID }}">Delete</a></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection
