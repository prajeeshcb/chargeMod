@extends('layouts.app')

@section('content')
<div class="container">
     <connections :user="{{ auth()->user() }}" id="connection"></connections> 

    	<!-- <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="form-group row">
                        <label for="IdTag" class="col-md-1 col-form-label text-md-right">ID Tag</label>

                        <div class="col-md-3">
                            <input id="IdTag" type="text" class="form-control" name="IdTag" required autocomplete="Id Tag" autofocus>
                        </div>
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-primary" >Authenticate</button>
                        </div>
                        <div class="col-md-3">
                           <button  class="btn btn-primary" @click.native="startCharging" >Start Charging</button> 
                           <button v-on:click="stopCharging" class="btn btn-primary" >Stop Charging</button>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row ">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <form method="POST" action="">
                        @csrf

                        <div class="form-group">
                        	<div class="input-group">
                               <label>Tag ID</label>
                                <input id="email" type="text" class="form-control" name="TagID" placeholder="1323456667567567" disabled="disabled">
                              </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                               <label>Vehicle Name</label>
                                <input id="email" type="text" class="form-control" name="TagID" placeholder="1323456667567567" disabled="disabled">
                              </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                               <label>Session Status</label>
                                <input id="email" type="text" class="form-control" name="TagID" placeholder="1323456667567567" disabled="disabled">
                              </div>
                        </div> 
                        
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
       

                <div class="card-body">
                    <form method="POST" action="">
                        @csrf

                        <div class="form-group">
                            <div class="input-group">
                               <label>Tag ID</label>
                                <input id="email" type="text" class="form-control" name="TagID" placeholder="1323456667567567" disabled="disabled">
                              </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                               <label>Vehicle Name</label>
                                <input id="email" type="text" class="form-control" name="TagID" placeholder="1323456667567567" disabled="disabled">
                              </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                               <label>Abedf</label>
                                <input id="email" type="text" class="form-control" name="TagID" placeholder="1323456667567567" disabled="disabled">
                              </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div> -->
    
    
     <!-- div class="row">
        <div class="col-md-6">
            <div class="card">
                 <div class="card-header">
                    <strong>PayLoad</strong>
                    
                </div>
                 <div class="card-body">
                    <ul class="list-unstyled" style="height:90px; overflow-y:scroll">
                        <li>hujkj</li>
                        <li>hujkj</li>
                        <li>hujkj</li>
                    </ul>
                 </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                 <div class="card-header">
                    Log 
                    <button type="submit" class="btn btn-primary" style="align-content: right;">
                                    {{ __('Clear') }}
                        </button> 
                </div>
                 <div class="card-body">
                    <ul style="height:90px; overflow-y:scroll">
                        <li>hujkj</li>
                        <li>hujkj</li>
                        <li>hujkj</li>
                    </ul>
                 </div>
            </div>
        </div>
    </div> 

</div> -->
@endsection

@section('scripts')
<script>

	/*const app = new Vue({
      		el: '#app',
     		data: {
      		payloads: {},
      	},
      	created() {
            this.fetchPayloads();
            Echo.join('chat')
                .listen('StartTransaction',(event)=>{*/
                    //this.messages.push(event.message);
                   /* console.log("hhh");
                })
        },
        methods :{
            fetchPayloads() {
                axios.get('payloads').then(response => {
                    this.payloads = response.data;
                })
            },
            startCharging() {
            	console.log('start');*/
                /*this.payloads.push ({
                    connectorId: this.connectorId,
                    IdTag:this.IdTag,
                    meterStart:this.meterStart,
                    reservationId:this.reservationId
                });
                axios.post('messages', {message: this.newMessage});
                this.clear();*/
           /* }
            stopCharging() {
            	console.log('stop');
            }

        }
    });*/

</script>
@endsection