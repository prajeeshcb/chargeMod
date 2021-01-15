@extends('layouts.app')
@section('title', 'users')

@section('header')
    <h1 class="page-title">Users</h1>
    <div class="page-header-actions">
        <a class="btn btn-sm btn-primary btn-round" href="{{ url('/addcustomer') }}">
            <i class="icon fa-plus" aria-hidden="true"></i>
            <span class="text hidden-sm-down">Add New User</span>
        </a>
    </div>
@endsection
@section('content')
@csrf
<div class="row">
    <div class="col-12">
        <div class="panel">
            <div class="panel-body">
                <table class="table table-hover dataTable table-striped w-full" data-plugin="dataTable">
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
                        <td><a href="/customer/edit/{{ $value->User_ID}}">Edit</a></td>
                        <td><a href="/customer/delete/{{ $value->User_ID}}">Deactivate</a></td>
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
</div>
@endsection