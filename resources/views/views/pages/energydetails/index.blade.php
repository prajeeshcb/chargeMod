@extends('layouts.app')
@section('title', 'Energydetails')

@section('header')
    <h1 class="page-title">Energy Details</h1>
@endsection
@section('content')
@csrf
<div class="card">
<table class="table table-bordered">
 <thead class="thead-dark">
    <tr>
        <th>ID</th>
        <th>Energy Unit</th>
        <th>Total Unit</th>
        <th>Energy Provider</th>
        <th>Date</th>
        <th>Unit Price</th>
        <th colspan="2">Actions</th>
    </tr>
 </thead>
    @foreach($data as $key => $value)
    <tr>
        <td>{{$value->id}}</td>
        <td>{{ $value->Energy_Unit}}</td>
        <td>{{ $value->Total_Unit}}</td>
        <td>{{ $value->Energy_Provider}}</td>
        <td>{{ $value->Date}}</td>
        <td>{{ $value->Unit_Price}}</td>
        <td><a href="/energydetails/edit/{{ $value->id }}">Edit</a></td>
        <td><a href="/energydetails/delete/{{ $value->id }}">Delete</a></td>
    </tr>
    @endforeach
</table>
</div>
<div class='row'>
    <div class="col-10"></div>
    <div class="col-2">
        <a href="/addenergydetails">Add New Energy Details</a>
    </div>
</div>
@endsection