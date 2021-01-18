@extends('layouts.app')
@section('title', 'Stations')
@section('header')
    <h1 class="page-title">Stations</h1>
    <div class="page-header-actions">
        <a class="btn btn-sm btn-primary btn-round" href="{{ url('/addstation') }}">
            <i class="icon fa-plus" aria-hidden="true"></i>
            <span class="text hidden-sm-down">Add Stations</span>
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
            </div>
        </div>
    </div>
</div>
@endsection