@extends('layouts.app')
@section('title', 'users')

@section('header')
    <h1 class="page-title">Users</h1>
@endsection
@section('content')
@csrf
<div class="card">
<table class="table table-bordered">
 <thead class="thead-dark">
    <tr>
        <th>User ID</th>
        <th>User Type</th>
        <th>Name of User</th>
        <th>Mobile No</th>
        <th>Username</th>
        <th>Password</th>
        <th>Address</th>
        <th>Pin Code</th>
        <th>State</th>
        <th>District</th>
        <th>Status</th>
        <th colspan="2">Actions</th>
    </tr>
 </thead>
    @foreach($data as $key => $value)
    <tr>
        <td>{{$value->User_ID}}</td>
        <td>{{ $value->User_Type}}</td>
        <td>{{ $value->User_Name}}</td>
        <td>{{ $value->User_Mobile}}</td>
        <td>{{ $value->Username}}</td>
        <td>{{ $value->User_Password}}</td>
        <td>{{ $value->User_Address}}</td>
        <td>{{ $value->User_Pin}}</td>
        <td>{{ $value->User_State}}</td>
        <td>{{ $value->User_District}}</td>
        <td>{{ $value->Status}}</td>
        <td><a href="/user/edit/{{ $value->User_ID}}">Edit</a></td>
        <td><a href="/user/delete/{{ $value->User_ID}}">Deactivate</a></td>
    </tr>
    @endforeach
</table>
</div>
<div class='row'>
    <div class="col-10"></div>
    <div class="col-2">
        <a href="/adduser">Add New User</a>
    </div>
</div>
@endsection