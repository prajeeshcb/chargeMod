@extends('layouts.app')
@section('title', 'Connector')

@section('header')
    <h1 class="page-title">Edit Connector Details</h1>

@endsection
@section('content')  
@csrf
<div class="panel">
  <div class="panel-body">
    <form method="POST" action="/connector/update/{{ $data->id }}">
      <input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>">
      <div class="row form-group">
        <div class="col-2">
          <label class="col-form-label">Connector Type</label>
        </div>
        <div class="col-8">
          <select name="Type">
            <option value="CSS" {{$data->Type == "CSS" ? 'selected': ''}}>CSS</option>
            <option value="Chademo" {{$data->Type == "Chademo" ? 'selected': ''}}>Chademo</option>
            <option value="GB/T"{{$data->Type == "GB/T" ? 'selected': ''}}>GB/T</option>
           </select>
        </div>
      </div>
      <div class="row form-group">
        <div class="col-2">
          <label class="col-form-label">Remarks</label>
        </div>
        <div class="col-8"> 
          <textarea name="Remarks" class="form-control">{{ $data->Remarks }}</textarea>
        </div>
      </div>
      <div class="row form-group">
          <div class="col-2">
            
          </div>
          <div class="col-8">
            <input type="submit" name="submit" class="btn btn-primary" value="submit">
          </div>
      </div>
    </form>
  </div>
</div>

@endsection