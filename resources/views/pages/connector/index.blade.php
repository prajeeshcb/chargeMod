@extends('layouts.app')
@section('title', 'Connector')

@section('header')
    <h1 class="page-title">List of Connectors</h1>
@endsection
@section('content')
@csrf
<div class="card">
<table class="table table-bordered">
 <thead class="thead-dark">
    <tr>
        <th>No</th>
        <th>Types</th>
        <th>Remarks</th>
        <th colspan="2">Actions</th>
    </tr>
 </thead>
    @foreach($data as $key => $value)
    <tr>
        <td>{{$value->id}}</td>
        <td>{{ $value->Type }}</td>
        <td>{{ $value->Remarks }}</td>
        <td><a href="/connector/edit/{{ $value->id }}">Edit</a></td>
        <td><a href="/connector/delete/{{ $value->id }}">Delete</a></td>
    </tr>
    @endforeach
</table>
</div>
<div class='row'>
    <div class="col-10"></div>
    <div class="col-2">
        <a href="/addconnector">Add New Connector</a>
    </div>
</div>
@endsection