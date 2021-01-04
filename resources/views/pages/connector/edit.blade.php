@extends('layouts.app')
@section('title', 'Connector')

@section('header')
    <h1 class="page-title">Edit Connector Details</h1>

@endsection
@section('content')  
@csrf

<form method="POST" action="/connector/update/{{ $data->id }}">
<input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>">
<div class="row">
  <div class="col-2">
    Connector Type
  </div>
  <div class="col-8">
    <input type="text" name="Type" value="{{$data->Type}}">
     
  </div>
</div><br>
<div class="row">
  <div class="col-2">
    Remarks
  </div>
  <div class="col-8"> 
    <textarea name="Remarks">{{ $data->Remarks }}</textarea>
  </div>
</div><br>
<div class="row">
  <div class="col-2"></div>
  <div class="col-8">
    <input type="submit" name="submit" class="btn btn-primary" value="Update">
  </div>
  </div>
</div>
</form>

@endsection