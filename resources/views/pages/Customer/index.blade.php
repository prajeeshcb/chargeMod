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
<form method="get" action="{{ url('/searchuser') }}" role="search">
<div class="row">
<div class="col-md-8">
    <input type="text" class="form-control" name="search" placeholder="Search..." >
</div>
<div class="col-md-2">
   <button type="btn btn-primary" type="submit"><i class="fa fa-search"  aria-hidden="true"></i></button>
</div>
</div> 
</form>  

<div class="row">
    <div class="col-12">
        <div class="panel">
            <div class="panel-body">
                <table class="table table-hover dataTable table-striped w-full" data-plugin="dataTable">
                 <thead class="thead-dark">
                    <tr>
                        <th>Sl No</th>
                        <th>User ID</th>
                        <th>Name of User</th>
                        <th>Mobile No</th>
                        <th>Username</th>
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
                        <td>{{$key+1}}</td>
                        <td>{{$value->User_ID}}</td>
                        <td>{{ $value->User_Name}}</td>
                        <td>{{ $value->User_Mobile}}</td>
                        <td>{{ $value->Username}}</td>
                        <td>{{ $value->User_Address}}</td>
                        <td>{{ $value->User_Pin}}</td>
                        <td>{{ $value->User_State}}</td>
                        <td>{{ $value->User_District}}</td>
                        <td>{{ $value->Status}}</td>
                        <td><a href="/customer/edit/{{ $value->User_ID}}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></td>
                        <td><a href="/customer/delete/{{ $value->User_ID}}" onclick="return confirm('Are you sure you want to deactivate this user')"><i class="fa fa-trash" aria-hidden="true"></i></a></td>
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
</div>
@endsection