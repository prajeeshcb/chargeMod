
  @extends('layouts.app')
@section('title', 'Connector')

@section('header')
    <h1 class="page-title">New Connectors</h1>

@endsection
@section('content')
@csrf
<form method="POST" action="/saveconnector">
<input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>">
<div class="row">
  <div class="col-2">
    Connector Type
  </div>
  <div class="col-8">
    <select name="Type">
      <option value="CCS">CCS</option>
      <option value="Chademo">Chademo</option>
      <option value="GB/T">GB/T</option>
    </select>
  </div>
</div><br>
<div class="row">
  <div class="col-2">
    Remarks
  </div>
  <div class="col-8"> 
    <textarea name="Remarks"></textarea>
  </div>
</div><br>
<div class="row">
  <div class="col-2"></div>
  <div class="col-8">
    <input type="submit" name="submit" class="btn btn-primary" value="submit">
  </div>
  </div>
</div>
</form>
@endsection

