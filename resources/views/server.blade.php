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
                                                <option value="">Select Station</option>
                                                @foreach($stations as $station)
                                                <option value="{{ $station['station_Id']}}">
                                                    {{ $station['station_Name']}}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <label>Charge Points</label>
                                    <ul class="list-unstyled charge-point-list" id="cp-list">
                                        <!-- <li>Charge Point1</li>
                                        <li>Charge Point2</li>
                                        <li>Charge Point3</li>
                                        <li>Charge Point4</li>
                                        <li>Charge Point5</li> -->
                                    </ul>
                                    <button class="btn btn-primary submit-btn">Submit</button>
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
                                                    <label class="col-6">Station</label>
                                                    <input id="charging_station" type="text" class="form-control col-6" name="URL"  disabled="disabled">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <label class="col-6">Connector Type</label>
                                                    <input id="connector_type" type="text" class="form-control col-6" name="URL"  disabled="disabled">
                                                </div>
                                                
                                            </div>
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <label class="col-6">Current Meter Reading</label>
                                                    <input id="meter_reading" type="text" class="form-control col-6" name="URL"  disabled="disabled">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <label class="col-6">Charge Point</label>
                                                    <input id="charge_point" type="text" class="form-control col-6" name="URL"  disabled="disabled">
                                                </div>
                                                
                                            </div>
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <label class="col-6">Status</label>
                                                    <input id="status" type="text" class="form-control col-6" name="URL"  disabled="disabled">
                                                </div>
                                                
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    
                                    <serveraction></serveraction>
                                    

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

@section('script')
<script type="text/javascript">
$(function() {
   $('#station').change(function(){
       var station = $(this).val();
       //alert(station_id);
       var html="";
       if(station!='')
       {
            $.ajax({
                type:'GET',
                url:'{{URL::to("/charge_points")}}/'+station,
                success:function(data)
                {
                   if(data!='')
                   {
                     $.each(data,function(i,value){
                     
                       html +='<li><input type="radio" name="cp" value="'+value.id+'">'+value.charge_point_vendor+'-'+value.connector_Name+'</a></li>';
                      
                      });

                   }

                   $('#cp-list').html(html);
                }
            });
       }
       /*else
       {
          html +='<option value="">please select</option>';
          $('#product').html(html);
       }*/
     });
   $('.submit-btn').click(function() {
        var station =  $('#station').find(":selected").val();
        var cp = $("input[name='cp']:checked").val();
        if(station!='' && cp!='')
        {
            $.ajax({
                type:'GET',
                url:'{{URL::to("/charge_point/info")}}/'+station+'/'+cp,
                success:function(data)
                {
                   if(data!='')
                   {
                        document.getElementById("charging_station").value= data['station_Name'];
                        document.getElementById("connector_type").value= data['connector_Name'];
                        document.getElementById("meter_reading").value= "1333";
                        document.getElementById("charge_point").value= data['charge_point_vendor'];
                        if(data['status'] == 1) {
                            document.getElementById("status").value= "Unlock";
                        }
                        if(data['status']==2) {
                            document.getElementById("status").value= "Lock";
                        }

                   }
                }
            });

        }
        else 
        {
            alert('Please Select station and charge point')
        }
    });
});
</script>
@endsection

