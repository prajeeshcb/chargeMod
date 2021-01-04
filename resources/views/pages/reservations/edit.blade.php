@extends('layouts.app')
@section('title', 'Reservations')

@section('header')
    <h1 class="page-title">New reservations</h1>

@endsection
@section('content')
@csrf
<form method="POST" action="/reservation/update/{{ $data->id }}">
<input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>">
<div class="row">
        <div class="col-2">
            User ID
        </div>
        <div class="col-8">
            <input type="text" name="User_ID" style="width:100%" value="{{ $data->User_ID}}">
        </div>
    </div><br>
    <div class="row">
        <div class="col-2">
            Charging Station ID
        </div>
        <div class="col-8">
            <input type="number" name="CS_ID" style="width:100%" value="{{ $data->CS_ID}}">
        </div>
    </div><br>
    <div class="row">
        <div class="col-2">
            Charging Point ID
        </div>
        <div class="col-8">
            <input type="number" name="CP_ID" style="width:100%" value="{{ $data->CP_ID}}">
        </div>
    </div><br>
    <div class="row">
        <div class="col-2">
            Connector ID
        </div>
        <div class="col-8">
            <input type="number" name="Connector_ID" style="width:100%" value="{{ $data->Connector_ID}}">
        </div>
    </div><br>
    <div class="row">
        <div class="col-2">
            Reservation Date
        </div>
        <div class="col-8">
            <input type="datetime" name="Reserve_Date" style="width:100%" value="{{$data->Reserve_Date}}">
        </div>
    </div><br>
    <div class="row">
        <div class="col-2">
            Reservation Starting Time
        </div>
        <div class="col-8">
            <input type="datetime" name="Reserve_Time_From" style="width:100%" value="{{ $data->Reserve_Time_From}}">
        </div>
    </div><br>
    <div class="row">
        <div class="col-2">
            Reservation Ending Time
        </div>
        <div class="col-8">
            <input type="datetime" name="Reserve_Time_End" style="width:100%" value="{{ $data->Reserve_Time_End}}">
        </div>
    </div><br>
    <div class="row">
        <div class="col-2">
            Reservation ID
        </div>
        <div class="col-8">
            <input type="text" name="Reservation_ID" style="width:100%" value="{{ $data->Reservation_ID}}">
        </div>
    </div><br>
    <div class="row">
        <div class="col-2">
            User Present Location
        </div>
        <div class="col-8">
            <input type="number" step="0.01" name="User_Present_Loc" style="width:100%" value="{{ $data->User_Present_Loc}}">
        </div>
    </div><br>
    <div class="row">
  <div class="col-2"></div>
  <div class="col-8">
    <input type="submit" name="submit" class="btn btn-primary" value="submit">
  </div>
  </div>
</form>
@endsection

