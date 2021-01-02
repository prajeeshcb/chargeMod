@extends('layouts.app')
@section('title', 'Connector')

@section('header')
    <h1 class="page-title">Chargepoints</h1>

@endsection
@section('content')
@csrf
<div class="card">
<table class="table table-bordered">
<thead class="thead-dark">
    <tr>
        <th>CP_ID</th>
        <th>CP_Name</th>
        <th>CP_State</th>
        <th>CP_District</th>
        <th>CP_Loc</th>
        <th>CP_Connector_Type</th>
        <th>CB_Serial_No</th>
        <th>CP_Serial_No</th>
        <th>CP_Firmware_Ver</th>
        <th>CP_Meter_Serial_No</th>
        <th>CP_Meter_Type</th>
        <th>Station_Phone</th>
        <th>Station_Email</th>
        <th>CP_Status</th>
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
