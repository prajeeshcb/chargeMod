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
                           <button v-on:click="bootNotification" class="btn btn-primary" id="disable">Start Charging</button> 
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
            bootNotification() {
                var msgId = Math.floor(100000 + Math.random() * 900000);
                axios.post('bootNotification', {MessageTypeId:"2",UniqueId:msgId, Action:"BootNotification",data:{chargePointVendor: "Point1", chargePointModel: "Model1", chargePointSerialNumber: "CP1234",chargeBoxSerialNumber: "CB1234" , firmwareVersion: "v1",iccid:"1111",imsi:"2222", meterType:"meter_type1", meterSerialNumber:"MTR1234"}})
                .then((response) => {
                    this.payloads = response.data;
                    var res_data = response.data;
                    
                    if(res_data.data.status=="Accepted")
                    {
                        this.startCharging();
                    }
                    else 
                    {
                        console.log('reject');
                        this.inter = setInterval(() => this.bootNotification(), 6000);
                    }
                })
                .catch((error) => {
                    console.log(error);
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
             
                // this.interval = setTimeout(function heartbeat() {
                //      document.getElementById("request").innerHTML= "Active";
                //       document.getElementById("response").innerHTML= "Yes";
                      
                // },2000);
                  axios.post('startCharging', {data:{message: "Active"}})
                 .then((response) => {
                    this.payloads = response.data;
                    console.log(response.data);
                })
                 .catch((error) => {
                    console.log(error);
                })

                this.interval = setTimeout(function meterValues(){
                    var msgId = Math.floor(100000 + Math.random() * 900000);
                    axios.post('meterValue', {MessageTypeId:"2",UniqueId:msgId, Action:"MeterValues",data:{connectorId: "1111", transactionId: "94", meterValue:{timeStamp:"02-10-2020", stampledValue:{context:"other", format: "signedData", measurand: "Power offered", phase:"LI", location: "EV", unit :"Kwh"}}}})
                    .then((response) => {
                        this.payloads = response.data;
                        console.log(response.data);
                    })
                    .catch((error) => {
                        console.log(error);
                    })
                },10000);


               
            },
            stopCharging() {
                 alert("Charging Completed");
                document.getElementById("request").innerHTML= "";
                document.getElementById("response").innerHTML= "";
                 document.getElementById("disable").disabled =false;
                  document.getElementById("enable").disabled =true;
                document.getElementById("status").value= "stop";

                var msgId = Math.floor(100000 + Math.random() * 900000);
                axios.post('stopCharging', {MessageTypeId:"2",UniqueId:msgId, Action:"StopTransacion",data:{idTag: "567890", meterStop: "3333", transactionId:"32434", reason: "Emergency stop", transactionData:{timeStamp:"02-10-2020", stampledValue:{context:"other", format: "signedData", measurand: "Power offered", phase:"LI", location: "EV", unit :"Kwh"}}}})
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
