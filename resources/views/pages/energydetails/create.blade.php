@extends('layouts.app')
@section('title', 'energydetails')

@section('header')
    <h1 class="page-title">New EnergyDetails</h1>

@endsection
@section('content')
@csrf
<form method="POST" action="/saveenergydetails">
<input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>">
<div class="row">
        <div class="col-2">
            Unit of Energy
        </div>
        <div class="col-8">
            <input type="text" name="Energy_Unit" style="width:100%">
        </div>
    </div><br>
    <div class="row">
        <div class="col-2">
            Total Energy  Provided
        </div>
        <div class="col-8">
            <input type="number" name="Total_Unit" style="width:100%">
        </div>
    </div><br>
    <div class="row">
        <div class="col-2">
         Energy  Provider  
        </div>
        <div class="col-8">
            <input type="text" name="Energy_Provider" style="width:100%">
        </div>
    </div><br>
    <div class="row">
        <div class="col-2">
            Date
        </div>
        <div class="col-8">
            <input type="datetime-local" name="Date" style="width:100%">
        </div>
    </div><br>
    <div class="row">
        <div class="col-2">
           Unit Price of Energy
        </div>
        <div class="col-8">
            <input type="number" name="Unit_Price" style="width:100%">
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

