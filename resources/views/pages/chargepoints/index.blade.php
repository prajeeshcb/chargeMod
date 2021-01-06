@extends('layouts.app')
@section('title', 'Chargepoint')

@section('header')
    <h1 class="page-title">Chargepoints</h1>

@endsection
@section('content')
@csrf
<div class="card">
<table class="table table-bordered">
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
</table>
</div>
<div class='row'>
    <div class="col-10"></div>
    <div class="col-2">
        <a href="/addCP">Add New CP</a>
    </div>
</div>
@endsection
