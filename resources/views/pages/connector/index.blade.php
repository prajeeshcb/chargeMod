@extends('layouts.app')
@section('title', 'Connector')

@section('header')
    <h1 class="page-title">Connectors</h1>
    <div class="page-header-actions">
        <a class="btn btn-sm btn-primary btn-round" href="{{ url('/addconnector') }}">
            <i class="icon fa-plus" aria-hidden="true"></i>
            <span class="text hidden-sm-down">Add Connector</span>
        </a>
    </div>
@endsection
@section('content')
@csrf
<form method="get" action="{{ url('/searchconnector') }}" role="search">
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
                        <th>Types</th>
                        <th>Remarks</th>
                        <th colspan="2">Actions</th>
                    </tr>
                 </thead>
                 <tbody>
                    @foreach($data as $key => $value)
                    <tr>
                        <td>{{$key+1}}</td>
                        <td>{{ $value->Type }}</td>
                        <td>{{ $value->Remarks }}</td>
                        <td><a href="/connector/edit/{{ $value->id }}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></td>
                        <td><a href="/connector/delete/{{ $value->id }}" onclick="return confirm('Are you sure you want to delete this Connector')"><i class="fa fa-trash" aria-hidden="true"></i>
</a></td>
                    </tr>
                    @endforeach
                </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection