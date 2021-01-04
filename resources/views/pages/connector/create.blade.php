
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
    <input type="text" name="Type" style="width:100%">
  </div>
</div><br>
<div class="row">
  <div class="col-2">
    Remarks
  </div>
  <div class="col-8"> 
    <textarea name="Remarks" style="width:100%"></textarea>
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

