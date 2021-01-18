@extends('layouts.app')
@section('title', 'Transaction')

@section('header')
    <h1 class="page-title">New Transaction</h1>

@endsection
@section('content')
@csrf
<form method="POST" action="/savetransaction">
<input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>">
<div class="row">
        <div class="col-2">
            Connector ID
        </div>
        <div class="col-8">
            <input type="number" name="Connector_ID" style="width:100%">
        </div>
    </div><br>
    <div class="row">
        <div class="col-2">
            Charging Point ID
        </div>
        <div class="col-8">
            <input type="number" name="CP_ID" style="width:100%">
        </div>
    </div><br>
    <div class="row">
        <div class="col-2">
            Charging Station ID
        </div>
        <div class="col-8">
            <input type="number" name="CS_ID" style="width:100%">
        </div>
    </div><br>
    <div class="row">
        <div class="col-2">
            User ID
        </div>
        <div class="col-8">
            <input type="text" name="User_ID" style="width:100%">
        </div>
    </div><br>
    <div class="row">
        <div class="col-2">
            Reservation ID
        </div>
        <div class="col-8">
            <input type="text" name="Reservation_ID" style="width:100%">
        </div>
    </div><br>
    <div class="row">
        <div class="col-2">
           Date and Time of Transaction
        </div>
        <div class="col-8">
            <input type="datetime-local" name="Trans_DateTime" style="width:100%">
        </div>
    </div><br>
    <div class="row">
        <div class="col-2">
            Initial Meter value of Transaction
        </div>
        <div class="col-8">
            <input type="number" name="Trans_Meter_Start" style="width:100%">
        </div>
    </div><br>
    <div class="row">
        <div class="col-2">
        Final Meter value of Transaction
        </div>
        <div class="col-8">
            <input type="number" name="Trans_Meter_Stop" style="width:100%">
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

