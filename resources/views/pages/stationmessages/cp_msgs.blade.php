@extends('layouts.app')
@section('title', 'stationdevicemessages')

@section('header')
    <h1 class="page-title">Charge Point Messages</h1>
@endsection
@section('content')
@csrf
<div class="row">
        <div class="col-md-9">
            <div class="card">
                <div class="card-block">
                    <div class="row">
                        <div class="col-md-4 text-center border-right">
                            <h4 class="card-title">Phone</h4>
                            <p class="card-text">{{ $cp->Station_Phone }}</p>
                            <p class="card-text">{{ $cp->Station_Phone }}</p>
                        </div>
                        <div class="col-md-4 text-center border-right">
                            <h4 class="card-title">Email</h4>
                            <p class="card-text">{{ $cp->Station_Email}}</p>
                        </div>
                        <div class="col-md-4 text-center">
                            <h4 class="card-title">Status</h4>
                            @if ($cp->CP_Status == 1)
                                <span class="badge badge-success">Active</span>
                            @else
                                <span class="badge badge-danger">Inactive</span>
                            @endif
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-6 text-center border-right">
                            <h4 class="card-title">Address</h4>
                            <p class="card-text">
                                {{ $cp->CP_Loc }}, 
                                <br>
                                {{ $cp->CP_District  }}, 
                                <br>
                                {{ $cp->CP_State  }}
                            </p>
                            
                        </div>
                        <div class="col-md-6 text-center">
                            <h4 class="card-title">Blackbox Details</h4>
                            <p class="card-text"><strong>CP Serial No:</strong> {{ $cp->CP_Serial_No }}</p>
                            <p class="card-text"><strong>Device UUID:</strong> {{ $cp->CB_Serial_No }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel panel-bordered">
                <div class="panel-heading">
                    <h3 class="panel-title"><i class="icon fa-plug" aria-hidden="true"></i>Charging Pins</h3>
                </div>
                <div class="panel-body">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>Type</th>
                            <th>Remark</th>
                            <!-- <th>Type</th> -->
                            <th class="text-nowrap">Status</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($connector as $pin)
                            <tr>
                                <td>{{ $pin->Type }}</td>
                                <td>{{ $pin->Remarks }}</td>
                                <td>
                                    Active
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="panel panel-bordered">
                <h3>Device Nessages</h3>
                <div class="panel-body">
                <table class="table table-hover dataTable table-striped w-full" data-plugin="dataTable" id ="msg_table">
                    <thead class="thead-dark">
                        <tr>
                            <th>ID</th>
                            <th>Date</th>
                            <th>Station</th>
                            <th>Status</th>
                            <th>Type</th>
                            <th>Message</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(count($msgs)>0)
                        @foreach($msgs as $key => $value)
                        <tr>
                            <td>{{ $value->id }}</td>
                            <td>{{ $value->created_at }}</td>
                            <td><a href="{{URL::to('/CP/messages/'.$value->CP_ID)}}">{{ $value->CP_Name }}</a></td>
                            @if($value->CP_Status==1)
                            <td><span class="badge" style="background-color: green;color:white;">Active</span></td>
                            @else if($value->CP_Status!=1)
                            <td><span class="badge" style="background-color: red;color:white;">Inactive</span></td>
                            @endif
                            @if($value->type==0)
                            <td><span class="badge" style="background-color: green;color:white;">In</span></td>
                            @else 
                            <td><span class="badge" style="background-color: red;color:white;">Out</span></td>
                            @endif
                            <td><?php exec ("find ".$value->file_path." -type d -exec chmod 0777 {} +"); 
                                $strJsonFileContents = file_get_contents($value->file_path); ?>{{$strJsonFileContents }}
                            </td>
                        </tr>
                        @endforeach
                        @endif
                    </tbody>
                </table>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
<!-- <script src="{{ asset('/assets/datatables-bs4/js/dataTables.bootstrap4.js', config('app.asset_secure')) }}"></script>
<script type="text/javascript">
    $(function() {
        var table =  $('#msg_table').DataTable({
            //"processing": true,
            "bserverSide": true,
            'searching'   : true,
            "ajax": {
                url: "{{URL::to('/ajax/messages')}}",
                type: 'GET'
            },
            "columns": [
                {"data": "id"},
                {"data": "date"},
                {"data": "station"}
                {"data": "type"}
                {"data": "msg"}
            ],
        });
    });
</script> -->
@endpush
