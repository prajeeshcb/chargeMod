@extends('layouts.app')
@section('title', 'Chargepoint')

@section('header')
    <h1 class="page-title">Chargepoints</h1>
    <div class="page-header-actions">
        <a class="btn btn-sm btn-primary btn-round" href="{{ url('/addCP') }}">
            <i class="icon fa-plus" aria-hidden="true"></i>
            <span class="text hidden-sm-down">Add Chargepoint</span>
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
                            <th>Sl No</th>
                            <th>CP Name</th>
                            <th>CP State</th>
                            <th>CP District</th>
                            <th>CP Location</th>
                            <th>Station Phone</th>
                            <th>Station Email</th>
                            <th colspan="3">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data as $key => $value)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{ $value->CP_Name}}</td>
                            <td>{{ $value->CP_State}}</td>
                            <td>{{$value->CP_District}}</td>
                            <td>{{$value->CP_Loc}}</td>
                            <td>{{$value->Station_Phone}}</td>
                            <td>{{$value->Station_Email}}</td>
                            <!-- <td>{{$value->CP_Status}}</td> -->
                            <td><a href="/CP/edit/{{ $value->CP_ID }}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></td>
                            <td><a href="/CP/delete/{{ $value->CP_ID }}" onclick="return confirm('Are you sure you want to delete this CP')"><i class="fa fa-trash" aria-hidden="true"></i></a></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection
