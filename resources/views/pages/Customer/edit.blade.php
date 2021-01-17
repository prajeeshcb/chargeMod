@extends('layouts.app')
@section('title', 'users')

@section('header')
    <h1 class="page-title">Edit User Details</h1>

@endsection
@section('content')
@csrf
<form method="POST" action="/customer/update/{{ $data->User_ID}}">
<input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>">
<div class="row">
        <div class="col-2">
            Type of User
        </div>
        <div class="col-8">
           <!-- <select name="User_Type">
            <option value="1" {{ $data->User_Type == 1 ? 'selected' : '' }}>1(EV User)</option>
            <option value="2" {{ $data->User_Type == 2 ? 'selected' : '' }}>2(Fleet User)</option>
           </select> -->
           <input type=radio name="User_Type" value="1" {{ $data->User_Type == '1' ? 'checked' : ''}}>1(EV User)
           <input type=radio name="User_Type" value="2" {{ $data->User_Type == '2' ? 'checked' : ''}}>2(Fleet User)
        </div>
    </div><br>
    <div class="row">
        <div class="col-2">
            Name of User
        </div>
        <div class="col-8">
            <input type="string" name="User_Name" style="width:100%" value="{{ $data->User_Name}}">
        </div>
    </div><br>
    <div class="row">
        <div class="col-2">
          Mobile Number of User
        </div>
        <div class="col-8">
            <input type="tel" name="User_Mobile" pattern="[0-9]{3} [0-9]{3} [0-9]{4}" style="width:100%" value="{{ $data->User_Mobile}}">
        </div>
    </div><br>
    <div class="row">
        <div class="col-2">
            Username for login
        </div>
        <div class="col-8">
            <input type="text" name="Username" style="width:100%" value="{{ $data->Username}}">
        </div>
    </div><br>
    <div class="row">
        <div class="col-2">
            Password
        </div>
        <div class="col-8">
            <input type="text" name="User_Password" style="width:100%" value="{{ $data->User_Password}}">
        </div>
    </div><br>
    <div class="row">
        <div class="col-2">
           Address For Contact
        </div>
        <div class="col-8">
           <textarea name="User_Address"style="width:100%">{{ $data->User_Address}}</textarea>
        </div>
    </div><br>
    <div class="row">
        <div class="col-2">
            Pincode
        </div>
        <div class="col-8">
            <input type="text" name="User_Pin" style="width:100%" value="{{ $data->User_Pin}}">
        </div>
    </div><br>
    <div class="row">
        <div class="col-2">
            State
        </div>
        <div class="col-8">
            <input type="text" name="User_State" style="width:100%" value="{{ $data->User_State}}">
        </div>
    </div><br>
    <div class="row">
        <div class="col-2">
        District
        </div>
        <div class="col-8">
            <input type="text" name="User_District" style="width:100%" value="{{ $data->User_District}}">
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

