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
                <table class="table table-hover dataTable table-striped w-full" id ="msg_table">
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
                        <!-- @if(count($data)>0)
                        @foreach($data as $key => $value)
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
                            <td><?php exec ("find ".$value->file_path." -type d -exec sudo chmod 0777 {} +"); 
                                $strJsonFileContents = file_get_contents($value->file_path); ?>{{$strJsonFileContents }}</td>
                        </tr>
                        @endforeach
                        @endif -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script src="{{ asset('/assets/datatables-bs4/js/dataTables.bootstrap4.js', config('app.asset_secure')) }}"></script>
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
</script> 
@endpush
