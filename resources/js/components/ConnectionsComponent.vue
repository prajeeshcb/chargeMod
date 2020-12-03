<template>
<span>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="form-group row">
                        <label for="IdTag" class="col-1 col-form-label text-md-right">ID Tag</label>

                        <div class="col-3">
                            <input id="IdTag" type="text" class="form-control" name="IdTag" required autocomplete="Id Tag" autofocus>
                        </div>
                        <div class="col-2">
                            <button type="submit" class="btn btn-primary" >Authenticate</button>
                        </div>
                        <div class="col-3">
                           <button v-on:click="startCharging" class="btn btn-primary" id="disable">Start Charging</button> 
                           <button v-on:click="stopCharging" class="btn btn-primary" id="enable" disabled >Stop Charging</button>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row ">
        <div class="col-6">
            <div class="card">
                <div  class="card-body">
                        <div class="form-group">
                            <div class="input-group">
                               <label>User ID</label>
                                <input id="userid" type="text" class="form-control" name="TagID"  disabled="disabled">
                              </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                               <label>Tag ID</label>
                                <input id="tagid" type="text" class="form-control" name="TagID" disabled="disabled">
                              </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                               <label>Status</label>
                                <input id="status" type="text" class="form-control" name="TagID"  disabled="disabled">
                              </div>
                        </div>
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="card">
                <div class="card-body">
                        <div class="form-group">
                            <div class="input-group">
                               <label>Vehicle name</label>
                                <input id="vehicle" type="text" class="form-control" name="TagID"  disabled="disabled">
                              </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                               <label>Charging PIN ID</label>
                                <input id="chargepin" type="text" class="form-control" name="TagID"  disabled="disabled">
                              </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                               <label>Battery</label>
                                <input id="battery" type="text" class="form-control" name="TagID"  disabled="disabled">
                              </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-6">
            <div class="card">
                 <div class="card-header">
                    <strong>Payload </strong>
                </div>
                 <div class="card-body">
                    <ul style="height:90px; overflow-y:scroll">
                        
                        <div class="row">
                        <div class='col-6'>
                            <div id= "request" class="req">
                                <h6>{{req }}</h6>
                            </div>
                         </div>
                         <div class="col-6">
                            <div id="response" class="res">
                                <h6>{{res }}</h6>
                            </div>
                         </div>
                        </div>
                    </ul>
                 </div>
            </div>
        </div>
        <div class="col-6">
            <div class="card">
                 <div class="card-header">
                    <strong>Log </strong>
                    <button type="submit" class="btn btn-primary" style="align-content: right;">
                                   Clear
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
</span>

</template>

<script>
    export default {
        data() {
            return {
                payloads:[],
                msgId: ' ',
                req:'',
                res:''
            }
        },
        mounted() {
            console.log('mounted');
        },
        created() {
            this.fetchPayloads();
            Echo.join('chat')
                .listen('StartTransaction',(event)=>{
                    this.payloads.push(event.payload);
                    console.log("hhh");
                })
        },
        methods :{
            fetchPayloads() {
               axios.get('payloads').then(response => {
                    this.payloads = response.data;
                    console.log(this.payloads);
                })
            },
            startCharging() {
                
                var msgId = Math.floor(100000 + Math.random() * 900000);
                axios.post('startCharging', {MessageTypeId:"2",UniqueId:msgId, Action:"StartTransacion",data:{connectorId: "11111", idTag: "567890", meterStart: "2222", reservationId:"32434",status:"1"}})
                .then((response) => {
                    this.payloads = response.data;
                    console.log(response.data);
                })
                .catch((error) => {
                    console.log(error);
                })
               
                document.getElementById("enable").disabled = false;
                document.getElementById("disable").disabled = true;
                document.getElementById("userid").value= "1";
                document.getElementById("tagid").value= "567890";
                document.getElementById("status").value= "start";
                document.getElementById("vehicle").value= "altroz";
                document.getElementById("chargepin").value= "879";
                document.getElementById("battery").value= "zczczc";
             
                  this.interval = setTimeout(function heartbeat(){
                     document.getElementById("request").innerHTML= "Active";
                      document.getElementById("response").innerHTML= "Yes";
                      
                },2000);
               
            },
            stopCharging() {
                document.getElementById("request").innerHTML= "";
                document.getElementById("response").innerHTML= "";
                 document.getElementById("disable").disabled =false;
                  document.getElementById("enable").disabled =true;
                document.getElementById("status").value= "stop";
                var msgId = Math.floor(100000 + Math.random() * 900000);
                axios.post('stopCharging', {MessageTypeId:"2",UniqueId:msgId, Action:"StopTransacion",data:{idTag: "567890", meterStop: "3333", transactionId:"32434", reason: "Emergency stop", transactionData:{timeStamp:"02-10-2020", stampledValue:{context:other, format: "signedData", measurand: "Power offered", phase:"LI", location: EV, unit :"Kwh"}}}})
                .then((response) => {
                    this.payloads = response.data;
                    console.log(response.data);
                })
                .catch((error) => {
                    console.log(error);
                })
               
                 
               
            }

        }
    }
</script>
