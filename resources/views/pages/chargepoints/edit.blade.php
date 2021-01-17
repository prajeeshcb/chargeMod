@extends('layouts.app')
@section('title', 'Chargepoint')

@section('header')
    <h1 class="page-title">Edit ChargePoint Details</h1>

@endsection
@section('content')  
@csrf
<div class="panel">
    <div class="panel-body">
        <form method="POST" action="/CP/update/{{ $data->CP_ID }}">
            <input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>">
            <div class="row form-group">
                <div class="col-3">
                    <label class="col-form-label">ChargePoint Name</label>
                </div>
                <div class="col-8">
                    <input type="text" name="CP_Name" class="form-control" style="width:100%" value="{{$data->CP_Name}}">
                </div>
            </div>
            <div class="row form-group">
                <div class="col-3">
                    <label class="col-form-label">ChargePoint State</label>
                </div>
                <div class="col-8">
                    <input type="text" name="CP_State" class="form-control" style="width:100%" value="{{$data->CP_State}}">
                </div>
            </div>
            <div class="row form-group">
                <div class="col-3">
                    <label class="col-form-label">ChargePoint District</label>
                </div>
                <div class="col-8">
                    <input type="text" name="CP_District" class="form-control" style="width:100%"  value="{{$data->CP_District}}">
                </div>
            </div>
            <div class="row form-group">
                <div class="col-3">
                    <label class="col-form-label">ChargePoint Location</label>
                </div>
                <div class="col-8">
                    <input type="number" step="0.01" name="CP_Loc" class="form-control" style="width:100%"  value="{{$data->CP_Loc}}">
                </div>
            </div>
            <div class="row form-group">
                <div class="col-3">
                    <label class="col-form-label">ChargePoint Connector Type</label>
                </div>
                <div class="col-8">
                    <input type="number" name="CP_Connector_Type" class="form-control" style="width:100%" value="{{$data->CP_Connector_Type}}">
                </div>
            </div>
            <div class="row form-group">
                <div class="col-3">
                    <label class="col-form-label">ChargeBox Serial Number</label>
                </div>
                <div class="col-8">
                    <input type="text" name="CB_Serial_No" class="form-control"style="width:100%" value="{{$data->CB_Serial_No}}">
                </div>
            </div>
            <div class="row form-group">
                <div class="col-3">
                    <label class="col-form-label">ChargePoint Serial Number</label>
                </div>
                <div class="col-8">
                    <input type="text" name="CP_Serial_No" class="form-control" style="width:100%" value="{{$data->CP_Serial_No}}">
                </div>
            </div>
            <div class="row form-group">
                <div class="col-3">
                    <label class="col-form-label">ChargePoint Firmware Version</label>
                </div>
                <div class="col-8">
                    <input type="text" name="CP_Firmware_Ver" class="form-control" style="width:100%" value="{{$data->CP_Firmware_Ver}}">
                </div>
            </div>
            <div class="row form-group">
                <div class="col-3">
                    <label class="col-form-label">ChargePoint Meter Serial Number</label>
                </div>
                <div class="col-8">
                    <input type="text" name="CP_Meter_Serial_No" class="form-control" style="width:100%" value="{{$data->CP_Meter_Serial_No}}">
                </div>
            </div>
            <div class="row form-group">
                <div class="col-3">
                    <label class="col-form-label">ChargePoint Meter Type</label>
                </div>
                <div class="col-8">
                    <input type="text" name="CP_Meter_Type" class="form-control" style="width:100%" value="{{$data->CP_Meter_Type}}">
                </div>
            </div>
            <div class="row form-group">
                <div class="col-3">
                    <label class="col-form-label">Station Phone Number</label>
                </div>
                <div class="col-8">
                    <input type="tell" name="Station_Phone" pattern="[0-9]{3} [0-9]{3} [0-9]{4}" class="form-control" style="width:100%" value="{{$data->Station_Phone}}">
                </div>
            </div>
            <div class="row form-group">
                <div class="col-3">
                    <label class="col-form-label">Station Email</label>
                </div>
                <div class="col-8">
                    <input type="text" name="Station_Email" class="form-control" style="width:100%" value="{{$data->Station_Email}}">
                </div>
            </div>
            <div class="row form-group">
                <div class="col-3"></div>
                <div class="col-8">
                    <input type="submit" name="submit" class="btn btn-primary" value="Update">
                </div>
            </div>
        </form>
    </div>
</div>

@endsection