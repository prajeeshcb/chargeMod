@extends('layouts.app')
@section('title', 'Chargepoint')

@section('header')
    <h1 class="page-title">New Chargepoints</h1>

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
        <form method="POST" action="{{ url('/saveCP') }}">
            <!-- <input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>"> -->
            @csrf
            <div class="row form-group">
                <div class="col-2">
                    <label class="col-form-label">ChargePoint Name</label>
                </div>
                <div class="col-8">
                    <input type="text" name="CP_Name" class="form-control" style="width:100%">
                </div>
            </div>
            <div class="row form-group">
                <div class="col-2">
                    <label class="col-form-label">ChargePoint State</label>
                </div>
                <div class="col-8">
                    <input type="text" name="CP_State" class="form-control" style="width:100%">
                </div>
            </div>
            <div class="row form-group">
                <div class="col-2">
                    <label class="col-form-label">ChargePoint District</label>
                </div>
                <div class="col-8">
                    <input type="text" name="CP_District" class="form-control" style="width:100%">
                </div>
            </div>
            <div class="row form-group">
                <div class="col-2">
                    <label class="col-form-label">ChargePoint Location</label>
                </div>
                <div class="col-8">
                    <input type="number" step="0.01" name="CP_Loc" class="form-control"style="width:100%">
                </div>
            </div>
            <div class="row form-group">
                <div class="col-2">
                    <label class="col-form-label">ChargePoint Connector Type</label>
                </div>
                <div class="col-8">
                    <input type="number" name="CP_Connector_Type" class="form-control" style="width:100%">
                </div>
            </div>
            <div class="row form-group">
                <div class="col-2">
                    <label class="col-form-label">ChargeBox Serial Number</label>
                </div>
                <div class="col-8">
                    <input type="text" name="CB_Serial_No" class="form-control" style="width:100%">
                </div>
            </div>
            <div class="row form-group">
                <div class="col-2">
                    <label class="col-form-label">ChargePoint Serial Number</label>
                </div>
                <div class="col-8">
                    <input type="text" name="CP_Serial_No" class="form-control" style="width:100%">
                </div>
            </div>
            <div class="row form-group">
                <div class="col-2">
                    <label class="col-form-label">ChargePoint Firmware Version</label>
                </div>
                <div class="col-8">
                    <input type="text" name="CP_Firmware_Ver" class="form-control" style="width:100%">
                </div>
            </div>
            <div class="row form-group">
                <div class="col-2">
                    <label class="col-form-label">ChargePoint Meter Serial Number</label>
                </div>
                <div class="col-8">
                    <input type="text" name="CP_Meter_Serial_No" class="form-control" style="width:100%">
                </div>
            </div>
            <div class="row form-group">
                <div class="col-2">
                    <label class="col-form-label">ChargePoint Meter Type</label>
                </div>
                <div class="col-8">
                    <input type="text" name="CP_Meter_Type" class="form-control" style="width:100%">
                </div>
            </div>
            <div class="row form-group">
                <div class="col-2">
                    <label class="col-form-label">Station Phone Number</label>
                </div>
                <div class="col-8">
                    <input type="number" name="Station_Phone" class="form-control" style="width:100%">
                </div>
            </div>
            <div class="row form-group">
                <div class="col-2">
                    <label class="col-form-label">Station Email</label>
                </div>
                <div class="col-8">
                    <input type="text" name="Station_Email" class="form-control" style="width:100%">
                </div>
            </div>
            <div class="row form-group">
                <div class="col-2"></div>
                <div class="col-8">
                    <input type="submit" name="submit" class="btn btn-primary" value="submit">
                </div>
            </div>
        </form>
    </div>
</div>
@endsection