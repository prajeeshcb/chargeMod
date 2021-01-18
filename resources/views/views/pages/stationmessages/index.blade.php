@extends('layouts.app')
@section('title', 'stationdevicemessages')

@section('header')
    <h1 class="page-title">Station Device Messages</h1>
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
                            <th>ID</th>
                            <th>Date</th>
                            <th>Station</th>
                            <th>Type</th>
                            <th>Message</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection
