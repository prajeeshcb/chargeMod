@extends('layouts.app')
@section('title', 'Connector')

@section('header')
    <h1 class="page-title">List of Reservations</h1>
@endsection
@section('content')
@csrf
<div class="card">
<table class="table table-bordered">
 <thead class="thead-dark">
    <tr>
        <th>ID</th>
        <th>User_ID</th>
        <th>CS_ID</th>
        <th>CP_ID</th>
        <th>Connector_ID</th>
        <th>Reserve_Date</th>
        <th>Reserve_Time_From</th>
        <th>Reserve_Time_End</th>
        <th>Reservation_ID</th>
        <th>User_Present_Loc</th>
        <th colspan="2">Actions</th>
    </tr>
 </thead>
    @foreach($data as $key => $value)
    <tr>
        <td>{{$value->id}}</td>
        <td>{{ $value->User_ID }}</td>
        <td>{{ $value->CS_ID }}</td>
        <td>{{ $value->CP_ID }}</td>
        <td>{{ $value->Connector_ID }}</td>
        <td>{{ $value->Reserve_Date }}</td>
        <td>{{ $value->Reserve_Time_From }}</td>
        <td>{{ $value->Reserve_Time_End }}</td>
        <td>{{ $value->Reservation_ID }}</td>
        <td>{{ $value->User_Present_Loc}}</td>
        <td><a href="/reservation/edit/{{ $value->id }}">Edit</a></td>
        <td><a href="/reservation/delete/{{ $value->id }}">Delete</a></td>
    </tr>
    @endforeach
</table>
</div>
<div class='row'>
    <div class="col-10"></div>
    <div class="col-2">
        <a href="/addreservation">Add New Reservations</a>
    </div>
</div>
@endsection