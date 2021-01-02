@extends('layouts.app')
@section('title', 'Connector')

@section('header')
    <h1 class="page-title">Edit Connector Details</h1>

@endsection
@section('content')  
@csrf

<form method="POST" action="/CP/update/{{ $data->CP_ID }}">
<input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>">
<div class="row">
        <div class="col-2">
            ChargePoint Name
        </div>
        <div class="col-8">
            <input type="text" name="CP_Name" style="width:100%" value="{{$data->CP_Name}}">
        </div>
    </div><br>
    <div class="row">
        <div class="col-2">
        ChargePoint State
        </div>
        <div class="col-8">
            <input type="text" name="CP_State" style="width:100%" value="{{$data->CP_State}}">
        </div>
    </div><br>
    <div class="row">
        <div class="col-2">
        ChargePoint District
        </div>
        <div class="col-8">
            <input type="text" name="CP_District" style="width:100%"  value="{{$data->CP_District}}">
        </div>
    </div><br>
    <div class="row">
        <div class="col-2">
        ChargePoint Location
        </div>
        <div class="col-8">
            <input type="number" step="0.01" name="CP_Loc" style="width:100%"  value="{{$data->CP_Loc}}">
        </div>
    </div><br>
    <div class="row">
        <div class="col-2">
        ChargePoint Connector Type
        </div>
        <div class="col-8">
            <input type="number" name="CP_Connector_Type" style="width:100%" value="{{$data->CP_Connector_Type}}">
        </div>
    </div><br>
    <div class="row">
        <div class="col-2">
        ChargeBox Serial Number
        </div>
        <div class="col-8">
            <input type="text" name="CB_Serial_No" style="width:100%" value="{{$data->CB_Serial_No}}">
        </div>
    </div><br>
    <div class="row">
        <div class="col-2">
        ChargePoint Serial Number
        </div>
        <div class="col-8">
            <input type="text" name="CP_Serial_No" style="width:100%" value="{{$data->CP_Serial_No}}">
        </div>
    </div><br>
    <div class="row">
        <div class="col-2">
        ChargePoint Firmware Version
        </div>
        <div class="col-8">
            <input type="text" name="CP_Firmware_Ver" style="width:100%" value="{{$data->CP_Firmware_Ver}}">
        </div>
    </div><br>
    <div class="row">
        <div class="col-2">
        ChargePoint Meter Serial Number
        </div>
        <div class="col-8">
            <input type="text" name="CP_Meter_Serial_No" style="width:100%" value="{{$data->CP_Meter_Serial_No}}">
        </div>
    </div><br>
    <div class="row">
        <div class="col-2">
        ChargePoint Meter Type
        </div>
        <div class="col-8">
            <input type="text" name="CP_Meter_Type" style="width:100%" value="{{$data->CP_Meter_Type}}">
        </div>
    </div><br>
    <div class="row">
        <div class="col-2">
        Station Phone Number
        </div>
        <div class="col-8">
            <input type="number" name="Station_Phone" style="width:100%" value="{{$data->Station_Phone}}">
        </div>
    </div><br>
    <div class="row">
        <div class="col-2">
        Station Email
        </div>
        <div class="col-8">
            <input type="text" name="Station_Email" style="width:100%" value="{{$data->Station_Email}}">
        </div>
    </div><br>
    <div class="row">
        <div class="col-2">
        ChargePoint Status
        </div>
        <div class="col-8">
            <input type="number" name="CP_Status" style="width:100%" value="{{$data->CP_Status}}">
        </div>
    </div><br>
    <div class="row">
  <div class="col-2"></div>
  <div class="col-8">
    <input type="submit" name="submit" class="btn btn-primary" value="Update">
  </div>
  </div>
</form>

@endsection