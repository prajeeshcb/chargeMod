@extends('layouts.app')
@section('title', 'Chargepoint')

@section('header')
    <h1 class="page-title">Edit ChargePoint Details</h1>

@endsection
@section('content')  
@csrf
@if(session()->has('message'))
<div class="col-lg-10">
    <div role="alert" class="alert alert-success alert-dismissible">
        <button aria-label="Close" data-dismiss="alert" class="close" type="button"><span aria-hidden="true">×</span></button>
        <strong>Success! </strong>{{ Session::get('message') }}
    </div>
</div>
<div class="clearfix"></div>
@endif
<!-- Main content -->
          
@if($errors->any())
    <div class="col-xs-12">  
        <div role="alert" class="alert alert-danger alert-dismissible" style="margin-top: 25px;">
            <button aria-label="Close" data-dismiss="alert" class="close" type="button"><span aria-hidden="true">×</span></button>
            <strong>Whoops!</strong> There were some problems with your input.
            <br/>
            <ul>
                @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    </div>
@endif
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
                    <select name="CP_Connector_Type">
                        @foreach($connector as $con)
                        <option value="{{$con['id'] }}" {{ $con['id'] == $data->CP_Connector_Type ? 'selected' : '' }}>
                        {{$con['Type'] }}</option>
                        @endforeach
                    </select>
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
                    <input type="tell" name="Station_Phone" pattern="[6-9]{1}[0-9]{9}" class="form-control" style="width:100%" value="{{$data->Station_Phone}}">
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