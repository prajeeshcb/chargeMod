@extends('layouts.app')
@section('title', 'Chargepoint')

@section('header')
    <h1 class="page-title"> ChargePoint Details</h1>

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
        
            <div class="row form-group">
                <div class="col-12">
                    <label class="col-form-label">ChargePoint Name : {{$data->CP_Name}}</label>
                </div>
            </div>
            <div class="row form-group">
                <div class="col-12">
                    <label class="col-form-label">ChargePoint State : {{$data->CP_State}}</label>
                </div>
            </div>
            <div class="row form-group">
                <div class="col-12">
                    <label class="col-form-label">ChargePoint District : {{$data->CP_District}}</label>
                </div>
            </div>
            <div class="row form-group">
                <div class="col-12">
                    <label class="col-form-label">ChargePoint Location : {{$data->CP_Loc}}</label>
                </div>
            </div>
            <div class="row form-group">
                <div class="col-12">
                    <label class="col-form-label">ChargePoint Connector Type : {{$data->CP_Connector_Type}}</label>
                </div>
            </div>
            <div class="row form-group">
                <div class="col-12">
                    <label class="col-form-label">ChargeBox Serial Number : {{$data->CB_Serial_No}}</label>
                </div>
            </div>
            <div class="row form-group">
                <div class="col-12">
                    <label class="col-form-label">ChargePoint Serial Number : {{$data->CP_Serial_No}}</label>
                </div>
            </div>
            <div class="row form-group">
                <div class="col-12">
                    <label class="col-form-label">ChargePoint Firmware Version : {{$data->CP_Firmware_Ver}}</label>
                </div>
            </div>
            <div class="row form-group">
                <div class="col-12">
                    <label class="col-form-label">ChargePoint Meter Serial Number : {{$data->CP_Meter_Serial_No}}</label>
                </div>
            </div>
            <div class="row form-group">
                <div class="col-12">
                    <label class="col-form-label">ChargePoint Meter Type : {{$data->CP_Meter_Type}}</label>
                </div>
            </div>
            <div class="row form-group">
                <div class="col-12">
                    <label class="col-form-label">Station Phone Number : {{$data->Station_Phone}}</label>
                </div>
            </div>
            <div class="row form-group">
                <div class="col-12">
                    <label class="col-form-label">Station Email : {{$data->Station_Email}}</label>
                </div>
               
            </div>
        
    </div>
</div>

@endsection