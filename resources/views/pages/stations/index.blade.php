@extends('layouts.app')
@section('title', 'Stations')
@section('header')
    <h1 class="page-title">Stations</h1>
@endsection
@section('content')
@csrf
<table class="table table-bordered">
 <thead class="thead-dark">
    <tr>
        <th>Id</th>
        <th>Station Name</th>
        <th>Phone</th>
        <th>Email</th>
        <th>Station Type</th>
        <th>Status</th>
        <th>Device Status</th>
        <th colspan="2">Actions</th>
    </tr>
 </thead>
 </table>
@endsection