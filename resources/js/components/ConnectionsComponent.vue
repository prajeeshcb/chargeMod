<template>
<span>
    
    <div class="row">
        <div class="col-12">
            <div class="card">
                <button v-on:click="bootNotification()" class="btn btn-primary" id="start" >Boot</button> 
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="form-group row">
                        <label for="IdTag" class="col-1 col-form-label text-md-right">ID Tag</label>

                        <div class="col-3">
                            <input id="IdTag" type="text" class="form-control" name="IdTag" v-model="IdTag" required autocomplete="Id Tag" autofocus>
                        </div>
                        <div class="col-2">
                            <button type="submit" v-on:click="Authenticate()" class="btn btn-primary" id="auth" disabled>Authenticate</button>
                        </div>
                        <div class="col-3">
                           <button v-on:click="startCharging" class="btn btn-primary" id="disable"  disabled>Start Charging</button> 
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
                    <ul style="height:170px; overflow-x:scroll">
                        
                        <div class="row">
                        <div class='col-12' v-for="(payload, index) in payloads" :key="index">
                            <div id= "request" class="req">
                                <b>{{payload.type}}</b>
                                <label>{{payload.data}}</label>
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
                res:'',
                flag:0 ,
                status:'',
                users:'',
                IdTag:''
            }
        },
        mounted() {
            console.log('mounted');
        },
        created() {
            // this.checktagID();
            // this.fetchbeats();
            // this.fetchPayloads();
            Echo.join('chat')
                .listen('StartTransaction',(event)=>{
                    this.payloads.push(event.payload);
                    console.log("hhh");
                })
        },
        methods :{
            fetchPayloads() {
               axios.get('payloads').then(response => {
                    this.payloads_1 = response.data;
                    console.log(this.payloads);
                })
            },
            bootNotification() {
                this.payloads.length=0;
                var msgId = Math.floor(100000 + Math.random() * 900000);
                document.getElementById("disable").enabled = true;
                // axios.post('bootNotification', {MessageTypeId:"2",UniqueId:this.msgId, Action:"BootNotification",data:{chargePointVendor: "Point1", chargePointModel: "Model1", chargePointSerialNumber: "CP1234",chargeBoxSerialNumber: "CB1234" , firmwareVersion: "v1",iccid:"1111",imsi:"2222", meterType:"meter_type1", meterSerialNumber:"MTR1234"}})
            
                // .then((response) => {
                    // var res_data = response.data; 
                
                    // if(res_data.data.status=="Accepted")
                    // {
                        document.getElementById("auth").disabled = false;
                        document.getElementById("start").disabled=true;

                        alert("Enter your Tag Id");
                    // }
                    // else 
                    // {
                    //   alert('Rejected');
                    //     this.inter = setInterval(() => this.bootNotification(), 6000);
                    // }
                
                    var req = '{MessageTypeId:"2",UniqueId:"746832", Action:"BootNotification",data:{chargePointVendor: "Point1", chargePointModel: "Model1", chargePointSerialNumber: "CP1234",chargeBoxSerialNumber: "CB1234" , firmwareVersion: "v1",iccid:"1111",imsi:"2222", meterType:"metertype1", meterSerialNumber:"MTR1234"}}';

                    this.payloads.push ({
                        type: 'BootNotification request',
                        data:req
                    });
                    axios.get('download_bootreq').then(response => {
                        var bootrequest = response.data;
                    })
                
                    // console.log(JSON.parse(JSON.stringify(response.data)));
                    var res={MessageTypeId:"3",UniqueId:"746832",data:{status:"Accepted",currenTime:"2020-12-12T02:58:57.8892785Z",interval:"2"}};
                    this.payloads.push ({
                        type: 'BootNotification response',
                        data:res
                    });
                    axios.get('download_bootres').then(response => {
                        var bootresponse = response.data;
                    })
                  
                // })
                // .catch((error) => {
                //     console.log(error);
                // })
                
                  
            },
            Authenticate(){
                this.payloads.length=0;
                if(this.IdTag == "")
                {
                     alert("Please enter a valid Tag ID");
                }
                else
                {
                    // this.payloads.legnth=0;
                    var req='{MessageTypeId:"2",UniqueId:"456378",idTag:567890}';
                    axios.get('download_authreq').then(response => {
                        var authrequest = response.data;
                    })
                    this.payloads.push ({
                        type: 'Authorize request',
                        data:req
                    });
                    var res='{MessageTypeId:"3",Uniqueid:"456378",IdTagInfo:{status:"Accepted",expiryDate:"2021-3-8T3.00PM",parentIdTag:567890}}';
                    axios.get('download_authres').then(response => {
                        var authresponse = response.data;
                    })
                    this.payloads.push ({
                        type: 'Authorize response',
                        data:res
                    });
                     
                    alert("Successfully authenticated.You can now start charging");
                    document.getElementById("disable").disabled=false;
                    document.getElementById("auth").disabled=true;
                   
                }
            },
            // checktagID()
        //     {
        //           axios.get('userdetails').then(response => {
        //              var userdetails = response.data;
        //              console.log(userdetails[4].status);
        //            for(users in userdetails)
        //            {
        //               if(users.data.status === "1")
        //                 {
                       
        //                     alert("A user is charging with the same TagId");
        //                 }
                
        //             else 
        //                 {
        //                     this.startCharging();
        //                 }
        //             }
        //         })
        //         .catch((error) => {
        //           console.log(error);
        //       })
        //    this.startCharging();
            
        //     },
            startCharging() {
                this.payloads.length=0;
                var msgId = Math.floor(100000 + Math.random() * 900000);
                // axios.post('startCharging', {MessageTypeId:"2",UniqueId:msgId, Action:"StartTransacion",data:{user_id:"12",connectorId: "11111", idTag: "567890", meterStart: "2222", reservationId:"32434",status:"1"}})
               
                // .then((response) => {
                    var req = '{MessageTypeId:"2",UniqueId:678534, Action:"StartTransacion",data:{connectorId: "11111", idTag: "567890", meterStart: "2222", reservationId:"32434",status:"1"}}';
                    axios.get('download_startreq').then(response => {
                        var startrequest = response.data;
                    })
                    this.payloads.push ({
                        type: 'StartTransacion request',
                        data:req
                    });
                    var res='{MessageTypeId:"3",UniqueId:"678534",data:{TransactionId: "1",IdTagInfo:{name:"asas",model:"ddss342",charging_time:"45min",charging_pin_id:"438"}}}';
                    // console.log(JSON.parse(JSON.stringify(response.data)));
                    axios.get('download_startres').then(response => {
                        var startresponse = response.data;
                    })
                    this.payloads.push ({
                        type: 'StartTransacion response',
                        data:res
                    });
                    
                    this.flag = 1;
                    this.interval1 = setInterval(() => this.heartBeat(), 6000);
                    this.interval2 = setInterval(() => this.meterValues(), 10000);

                //  }
                // )
                // .catch((error) => {
                //     console.log(error);
                // })


               
                document.getElementById("enable").disabled = false;
                document.getElementById("disable").disabled = true;
                document.getElementById("userid").value= "1";
                document.getElementById("tagid").value= this.IdTag;
                document.getElementById("status").value= "start";
                document.getElementById("vehicle").value= "altroz";
                document.getElementById("chargepin").value= "879";
                document.getElementById("battery").value= "zczczc";

               
            },
            meterValues() {
                if(this.flag == 1) {
                    var msgId = Math.floor(100000 + Math.random() * 900000);
                    // axios.post('meterValue', {MessageTypeId:"2",UniqueId:msgId, Action:"MeterValues",data:{connectorId: "1111", transactionId: "94", meterValue:{timeStamp:"02-10-2020", stampledValue:{context:"other", format: "signedData", measurand: "Power offered", phase:"LI", location: "EV", unit :"Kwh"}}}})
                    
                    //  .then((response) => {
                      var req = '{MessageTypeId:"2",UniqueId:342337, Action:"MeterValues",data:{connectorId: "1111",meterValue:{stampledValue:{context:"other", format: "signedData",location: "EV", measurand: "Power offered", phase:"LI",unit :"Kwh"},timeStamp:"02-10-2020"},transactionId: "32434"}}';
                    axios.get('download_meterreq').then(response => {
                        var Metervaluerequest = response.data;
                    })
                        this.payloads.push ({
                            type: 'MeterValues request',
                            data:req
                        });

                        // console.log(JSON.parse(JSON.stringify(response.data)));
                        var res='{MessagetypeId:"3",UniqueId:"342337",data:[]}';
                        axios.get('download_meterres').then(response => {
                            var MetervalueResponse = response.data;
                        })
                        this.payloads.push ({
                            type: 'MeterValues response',
                            data:res
                        });
                    // })
                    // .catch((error) => {
                    //     console.log(error);
                    // })
                 }
            },
            heartBeat() {
                if(this.flag == 1) {
                    var msgId = Math.floor(100000 + Math.random() * 900000);
                    // axios.post('heartBeat', {MessageTypeId:"2",UniqueId:msgId, Action:"HeartBeat",data:""})
                    
                    // .then((response) => {
                        var req = '{MessageTypeId:"2",UniqueId:334741, Action:"HeartBeat",data:""}';
                         axios.get('download_heartbeat').then(response => {
                            var heartbeat = response.data;
                        })
                        this.payloads.push ({
                            type: 'HeartBeat request',
                            data:req
                        });

                        // console.log(JSON.parse(JSON.stringify(response.data)));
                        var res= '{MessagetypeId:"3",UniqueId:"334741", "currentTime": "2013-02-01T15:09:18Z" }';
                        axios.get('download_heartbeatres').then(response => {
                            var heartbeatresponse = response.data;
                        })
                        this.payloads.push ({
                            type: 'HeartBeat response',
                            data:res
                        });
                    // })
                    // .catch((error) => {
                    //     console.log(error);
                    // })
                }
            },
           
            stopCharging() {
                
                alert("Do you want to stop charging");
              document.getElementById("disable").disabled =false;
                document.getElementById("enable").disabled =true;
                document.getElementById("status").value= "stop";
                document.getElementById("tagid").value= this.IdTag;
                var msgId = Math.floor(100000 + Math.random() * 900000);
                // axios.post('stopCharging', {MessageTypeId:"2",UniqueId:msgId, Action:"StopTransacion",data:{idTag: "567890", meterStop: "3333", transactionId:"32434", reason: "Emergency stop", transactionData:{timeStamp:"02-10-2020", stampledValue:{context:"other", format: "signedData", measurand: "Power offered", phase:"LI", location: "EV", unit :"Kwh"}}}})
                
                // .then((response) => {
                    this.flag = 0;
                    var req = '{MessageTypeId:"2",UniqueId:754557, Action:"StopTransacion",data:{idTag: "567890", meterStop: "3333",reason: "Emergency stop",transactionData:{stampledValue:{context:"other", format: "signedData",location: "EV", measurand: "Power offered", phase:"LI",unit :"Kwh"},timeStamp:"02-10-2020"},transactionId:"23345"}}';
                    axios.get('download_stopreq').then(response => {
                        var stoprequest = response.data;
                    })
                    this.payloads.push ({
                        type: 'StopTransacion request',
                        data:req
                    });

                    // console.log(JSON.parse(JSON.stringify(response.data)));
                    var res='{"MessageTypeId:"3",,UniqueId:"754557","Status:"2"}';
                    axios.get('download_stopres').then(response => {
                        var stopresponse = response.data;
                    })
                    this.payloads.push ({
                        type: 'StopTransacion response',
                        data:res
                    });

                    
                    
                // })
                // .catch((error) => {
                //     console.log(error);
                // })
               
                 
               
            }

        }
    }
    
</script>
