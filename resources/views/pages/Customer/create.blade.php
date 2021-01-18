@extends('layouts.app')
@section('title', 'user')

@section('header')
    <h1 class="page-title">New User</h1>

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
<form method="POST" action="/savecustomer">
<input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>">
<div class="row">
        <div class="col-2">
            Type of User
        </div>
        <div class="col-8">
           <input  type="radio" name="User_Type" value="1">1(EV User)
           <input  type="radio" name="User_Type" value="2">2(Fleet User)
        </div>
    </div><br>
    <div class="row">
        <div class="col-2">
            Name of User
        </div>
        <div class="col-8">
            <input type="string" name="User_Name" style="width:100%">
        </div>
    </div><br>
    <div class="row">
        <div class="col-2">
          Mobile Number of User
        </div>
        <div class="col-8">
            <input type="tel" name="User_Mobile" placeholder="888 888 8888" pattern="[0-9]{3} [0-9]{3} [0-9]{4}"  style="width:100%">
        </div>
    </div><br>
    <div class="row">
        <div class="col-2">
            Username for login
        </div>
        <div class="col-8">
            <input type="text" name="Username" style="width:100%">
        </div>
    </div><br>
    <div class="row">
        <div class="col-2">
            Password
        </div>
        <div class="col-8">
            <input type="password" name="User_Password" style="width:100%">
        </div>
    </div><br>
    <div class="row">
        <div class="col-2">
           Address For Contact
        </div>
        <div class="col-8">
           <textarea name="User_Address"style="width:100%"></textarea>
        </div>
    </div><br>
    <div class="row">
        <div class="col-2">
            Pincode
        </div>
        <div class="col-8">
            <input type="text" name="User_Pin" style="width:100%">
        </div>
    </div><br>
    <div class="row">
        <div class="col-2">
            State
        </div>
        <div class="col-8">
            <input type="text" name="User_State" style="width:100%">
        </div>
    </div><br>
    <div class="row">
        <div class="col-2">
        District
        </div>
        <div class="col-8">
            <input type="text" name="User_District" style="width:100%">
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


