@extends('layouts.app')

@section('content')
<div class="container">
    <!-- <serverview :user="{{ auth()->user() }}"></serverview> -->
    <span>
    <div class="row ">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header" style="text-align: center;"><h2>Server Monitoring</h2> </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="card card-primary">
                                <div class="card-header">
                                    <span class="sub-headings">Charge Points</span>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label>Charging Station</label>
                                        <div class="input-group">
                                            <select name="station" id="station" class="form-control">
                                                <option value="{{$co->id}}">Select Station</option>
                                                @foreach($stations as $station)
                                                    <option>{{ $station['station_Name']}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <label>Charge Points</label>
                                    <ul class="list-unstyled charge-point-list">
                                        <li>Charge Point1</li>
                                        <li>Charge Point2</li>
                                        <li>Charge Point3</li>
                                        <li>Charge Point4</li>
                                        <li>Charge Point5</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="card">
                                <div class="card-header">
                                    <span class="sub-headings">&nbsp;&nbsp;Charge Point Info</span>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <label>URL</label>
                                                    <input id="vehicle" type="text" class="form-control" name="URL"  disabled="disabled">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <label>Tag Id</label>
                                                    <input id="vehicle" type="text" class="form-control" name="URL"  disabled="disabled">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <label>Status</label>
                                                    <input id="vehicle" type="text" class="form-control" name="URL"  disabled="disabled">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <label>Current Meter Reading</label>
                                                    <input id="vehicle" type="text" class="form-control" name="URL"  disabled="disabled">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class=row>
                                        <span style="text-align: center;">
                                            <h5 style="font-weight: bold;">Payload</h5>
                                        </span>
                                        <ul style="height:170px; overflow-x:scroll;border: 2px solid #6c757d;
  border-radius: 5px;">
                                            <li>
                                                {MessageTypeId:"2",UniqueId:msgId, Action:"BootNotification",data:{chargePointVendor: "Point1", chargePointModel: "Model1", chargePointSerialNumber: "CP1234",chargeBoxSerialNumber: "CB1234" , firmwareVersion: "v1",iccid:"1111",imsi:"2222", meterType:"meter_type1", meterSerialNumber:"MTR1234"}}
                                            </li>
                                            <li>
                                                {MessageTypeId:"2",UniqueId:msgId, Action:"BootNotification",data:{chargePointVendor: "Point1", chargePointModel: "Model1", chargePointSerialNumber: "CP1234",chargeBoxSerialNumber: "CB1234" , firmwareVersion: "v1",iccid:"1111",imsi:"2222", meterType:"meter_type1", meterSerialNumber:"MTR1234"}}
                                            </li>
                                        </ul>
                                    </div>

                                </div>

                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</span>
    
</div>
@endsection

@section()