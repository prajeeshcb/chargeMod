@extends('layouts.app')
@section('title', 'Transaction')

@section('header')
    <h1 class="page-title">Transactions</h1>
@endsection
@section('content')
@csrf
<div class="card">
<table class="table table-bordered">
 <thead class="thead-dark">
    <tr>
        <th>ID</th>
        <th>Connector ID</th>
        <th>ChargingPoint ID</th>
        <th>ChargingStation ID</th>
        <th>User ID</th>
        <th>Reservation ID</th>
        <th>Transaction Date and Time</th>
        <th>Initial Meter Value</th>
        <th>Final Meter Value</th>
        <th colspan="2">Actions</th>
    </tr>
 </thead>
    @foreach($data as $key => $value)
    <tr>
        <td>{{$value->id}}</td>
        <td>{{ $value->Connector_ID }}</td>
        <td>{{ $value->CP_ID }}</td>
        <td>{{ $value->CS_ID }}</td>
        <td>{{ $value->User_ID }}</td>
        <td>{{ $value->Reservation_ID}}</td>
        <td>{{ $value->Trans_DateTime}}</td>
        <td>{{ $value->Trans_Meter_Start}}</td>
        <td>{{ $value->Trans_Meter_Stop}}</td>
        <td><a href="/transaction/edit/{{ $value->id }}">Edit</a></td>
        <td><a href="/transaction/delete/{{ $value->id }}">Delete</a></td>
    </tr>
    @endforeach
</table>
</div>
<div class='row'>
    <div class="col-10"></div>
    <div class="col-2">
        <a href="/addtransaction">Add New Transaction</a>
    </div>
</div>
@endsection