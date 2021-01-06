@extends('layouts.app')
@section('title', 'Reservations')

@section('header')
    <h1 class="page-title">Reservations</h1>
@endsection
@section('content')
@csrf
<div class="card">
<table class="table table-bordered">
 <thead class="thead-dark">
    <tr>
        <th>User ID</th>
        <th>ChargingStation ID</th>
        <th>ChargingPoint ID</th>
        <th>Connector ID</th>
        <th>Reserved Date</th>
        <th>Reservation Startingtime</th>
        <th>Reservation Endingtime</th>
        <th>Reservation ID</th>
        <th>User Present Location</th>
        <th colspan="2">Actions</th>
    </tr>
 </thead>
    @foreach($data as $key => $value)
    <tr>
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