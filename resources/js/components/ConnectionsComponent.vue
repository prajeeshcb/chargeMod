<template>
<span> 
    <div class="row ">
        <div class="col-12">
            <div class="card">
                <div  class="card-body row">
                  <div class="form-group col-2">
                    <div class="input-group">
                      <label class="col-form-label text-md-right">Charge point</label>
                      <select v-model="chargepoint" class="custom-select" id="cp_select" v-on:click="getChargepoints()" @change='getConnectors()'>
                        <option v-bind:value="chargepoint.CP_ID" v-for="(chargepoint, index) in chargepoints">{{ chargepoint.CP_Name }} . 
                        </option>
                      </select>
                    </div>
                  </div>
                  <div class="form-group col-2">
                    <div class="input-group">
                      <label class="col-form-label text-md-right">Connector</label>
                      <select v-model="connector" class="custom-select" id="connector_select">
                        <option v-bind:value="connector.id" v-for="(connector, index) in connectors">{{ connector.Type }} . 
                        </option>
                      </select>
                    </div>
                  </div>
                  <div class="form-group col-3">
                    <div class="input-group">
                      <label class="col-form-label text-md-right">CB Serial No</label>
                      <input id="cbserial_no" type="text" class="form-control" name="cbserial_no" v-model="cbserial_no">
                    </div>
                  </div>
                  <div class="form-group col-3">
                    <div class="input-group">
                      <label class="col-form-label text-md-right">CP Serial No</label>
                      <input id="cpserial_no" type="text" class="form-control" name="cpserial_no" v-model="cpserial_no">
                    </div>
                  </div>
                  <div class="col-1">
                    <button v-on:click="bootNotification()" class="btn btn-primary btn-lg" id="boot" >Boot</button>
                  </div>
                </div>
                
            </div> 
         </div>
      </div> 
    <div class="row">
        <div class="col-12">
            <div class="card">
                 
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
                           <button v-on:click="startCharging" class="btn btn-primary" id="start"  disabled>Start Charging</button> 
                           <button v-on:click="stopCharging" class="btn btn-primary" id="stop" disabled >Stop Charging</button>
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
                        <!--<div class="form-group">
                            <div class="input-group">
                               <label>Tag ID</label>
                                <input id="tagid" type="text" class="form-control" name="TagID" disabled="disabled">
                              </div>
                        </div>-->
                        <!--<div class="form-group">
                            <div class="input-group">
                               <label>Status</label>
                                <input id="status" type="text" class="form-control" name="TagID"  disabled="disabled">
                              </div>
                        </div>-->
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="card">
                <div class="card-body">
                        <div class="form-group">
                            <div class="input-group">
                               <label>Tag ID</label>
                                <input id="tagid" type="text" class="form-control" name="TagID" disabled="disabled">
                              </div>
                        </div>
                        <!--<div class="form-group">
                            <div class="input-group">
                               <label>Vehicle name</label>
                                <input id="vehicle" type="text" class="form-control" name="TagID"  disabled="disabled">
                              </div>
                        </div>-->
                        <!--<div class="form-group">
                            <div class="input-group">
                               <label>Charging PIN ID</label>
                                <input id="chargepin" type="text" class="form-control" name="TagID"  disabled="disabled">
                              </div>
                        </div>-->
                        <!--<div class="form-group">
                            <div class="input-group">
                               <label>Battery</label>
                                <input id="battery" type="text" class="form-control" name="TagID"  disabled="disabled">
                              </div>
                        </div>-->
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
                    <ul style="height:170px; overflow-y:scroll">
                        
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

  name: 'App',
  data: function() {
    return {
      payloads:[],
                msgId: ' ',
                req:' ',
                res:'',
                flag:0 ,
                status:'',
                users:'',
                IdTag:'',
      connection: null,
      chargepoint: 0,
                chargepoints: [],
                connector: 0,
                connectors: []
    }
  },
  created: function() {
    console.log("Starting connection to WebSocket Server")
    this.connection = new WebSocket('ws://localhost:7000')


    this.connection.onmessage = function(event) {
    //alert(JSON.parse(event.data));
      var msg = JSON.parse(event.data);

      switch (msg.title) {
          case "BootNotificationResponse":
              BootNotificationResponse(msg);
              console.log('booottt');
              break;

          case "AuthenticateResponse":
              // console.log('authentication');
              authenticationResponse(msg);
              break;

           case "StartTransactionResponse":
              // console.log('StartTransaction');
              StartTransactionResponse(msg);
              flag = 1;
              setInterval(() => heartBeat(), 6000);
              setInterval(() => meterValues(), 10000);
              break;

           case "MeterValuesResponse":
              console.log('MeterValues');
              //MeterValues(msg);
              break;

            case "HeartBeatResponse":
              console.log('HeartBeat');
              //HeartBeat(msg);
              break;

            case "StopTransactionResponse":
               console.log('StopTransaction');
              StopTransactionResponse(msg);
              flag = 0;
              break;

            default:
              var text = "No value found";
              break;
        }

        function BootNotificationResponse(msg) {
          
            if(msg.payload.status=="Accepted")
            {
              document.getElementById("auth").disabled = false;
              document.getElementById("boot").disabled=true;
              document.getElementById("cbserial_no").disabled=true;
              document.getElementById("cpserial_no").disabled=true;
              document.getElementById("cp_select").disabled=true;
              document.getElementById("connector_select").disabled=true;
            }
            else {
              setInterval(() => bootNotification(), 6000);
            }
        }

        function authenticationResponse(msg) {
            
            if(msg.payload.status=="Accepted")
            {
              alert("Successfully authenticated.You can now start charging");
              document.getElementById("start").disabled=false;
              document.getElementById("auth").disabled=true;
            }
            else {
              alert("Invalid IdTag");
            }
        }

        function StartTransactionResponse(msg) {

          document.getElementById("stop").disabled = false;
          document.getElementById("start").disabled = true;
          document.getElementById("userid").value= "1";
          document.getElementById("tagid").value= this.IdTag;
          document.getElementById("status").value= "start";
          document.getElementById("vehicle").value= "altroz";
          document.getElementById("chargepin").value= "879";
          document.getElementById("battery").value= "zczczc";
        }

        function StopTransactionResponse(msg) {
          if(msg.payload,status=="Accepted")
          {
            alert('jjj');
          }
          //
          document.getElementById("start").disabled=false;
          document.getElementById("stop").disabled=true;
          document.getElementById("boot").disabled=false;
          
          document.getElementById("cbserial_no").disabled=false;
          document.getElementById("cpserial_no").disabled=false;
          document.getElementById("cp_select").disabled=false;

           window.location.reload();

          document.getElementById("connector_select").disabled=false;
          document.getElementById("cbserial_no").value=" ";
          document.getElementById("cpserial_no").value=" ";
          document.getElementById("cp_select").value=" ";
          document.getElementById("connector_select").value=" ";
        }

    }

    this.connection.onreadystate = function(event) {
      alert("Established Connection between client ans server")
    }

    this.connection.onopen = function(event) {
      console.log("Successfully connected to the websocket server...")
      alert("Successfully connected to the websocket server...");
    }
    this.connection.onerror = function(event) {
      alert("There is an error between the client and the server.")
    }
     

  },
  methods :{
    getChargepoints: function(){
              axios.get('/getChargepoints')
              .then(function (response) {
                 this.chargepoints = response.data;
                 console.log(response.data);
              }.bind(this));

    },
    getConnectors: function() {
                axios.get('/getConnectors',{
                 params: {
                   cp_id: this.chargepoint
                 }
              }).then(function(response){
                    this.connectors = response.data;
                }.bind(this));
    },
    bootNotification() {
      var msgId = Math.floor(100000 + Math.random() * 900000);
      var cpserial_no = this.cpserial_no;
      var cbserial_no = this.cbserial_no;
      var vendor = this.chargepoint;
      var connector = this.connector;
      alert(cbserial_no);
      var metadata = {
                      MessageTypeId:"2",
                    UniqueId:"746832",
                    title:"BootNotificationRequest",
                    payload:{
                        chargePointVendor:vendor,
                        connector:connector,
                        chargePointModel:"Model1",
                        chargePointSerialNumber:cpserial_no,
                        chargeBoxSerialNumber:cbserial_no,
                        firmwareVersion:"v1",
                        iccid:"1111",
                        imsi:"2222",
                        meterType:"metertype1",
                        meterSerialNumber:"MTR1234"
                      }
                    };
        var req = JSON.stringify(metadata);
        this.payloads.push ({
                        type: 'BootNotification Request',
                        data:req
                    });
        
        this.connection.send(JSON.stringify(metadata));
        
    },
    Authenticate(){
        var msgId = Math.floor(100000 + Math.random() * 900000);
        this.payloads.length=0;
        if(this.IdTag == "")
        {
          alert("Please enter a valid Tag ID");
        }
        else
        {
          // this.payloads.legnth=0;
          var id_Tag = this.IdTag;
          var cp = this.chargepoint;
          var connector = this.connector;
          var metadata = {
                            msgType: 2,
                            uniqueId:msgId,
                            title: "AuthenticateRequest",
                            payload: {
                              idTag:id_Tag,
                              chargepoint:cp,
                              connector:connector

                            }
                          };
           var req = JSON.stringify(metadata);
           this.payloads.push ({
                        type: 'Authentication Request',
                        data:req
                    });
          this.connection.send(JSON.stringify(metadata));
          
        }
    },
    startCharging() {
      // alert('kkk');
        var msgId = Math.floor(100000 + Math.random() * 900000);
        var cp = this.chargepoint;
        var connector = this.connector;
        var metadata = {
                          msgType: 2,
                          uniqueId:msgId,
                          title: "StartTransactionRequest",
                          payload: {
                              user_id:"12",
                              chargepoint: cp,
                              connectorId: connector,
                              idTag: "567890",
                              meterStart: "2222",
                              reservationId:"32434",
                              status:"1"
                          }
                        };
          var req = JSON.stringify(metadata);
          this.payloads.push ({
                        type: 'StartTransaction Request',
                        data:req
                    });
        this.connection.send(JSON.stringify(metadata));    
        this.flag = 1;
        this.interval1 = setInterval(() => this.heartBeat(), 6000);
        this.interval2 = setInterval(() => this.meterValues(), 10000);
    },
    meterValues() {
      if(this.flag == 1) {
        var msgId = Math.floor(100000 + Math.random() * 900000);
        var cp = this.chargepoint;
        var connector = this.connector;
        var metadata = {
                          msgType:"2",
                          UniqueId:msgId,
                          title:"MeterValuesRequest",
                          payload:{
                              connectorId: connector,
                              chargepoint:cp,
                              transactionId: "94", 
                              meterValue:{
                                timeStamp:"02-10-2020", 
                                stampledValue:{
                                  context:"other", 
                                  format: "signedData", 
                                  measurand: "Power offered", 
                                  phase:"LI", 
                                  location: "EV", 
                                  unit :"Kwh"
                                }
                              }
                            }
                        };
        var req = JSON.stringify(metadata);
        this.payloads.push ({
                        type: 'MeterValue Request',
                        data:req
                    });
        this.connection.send(JSON.stringify(metadata));
      }
    },
    heartBeat() {
      if(this.flag == 1) {
        var msgId = Math.floor(100000 + Math.random() * 900000);
        var cp = this.chargepoint;
        var connector = this.connector;
        var metadata = {
                          msgType:"2",
                          UniqueId:334741, 
                          title:"HeartBeatRequest",
                          payload:{
                            chargepoint: cp
                          }
                        };
          var req = JSON.stringify(metadata);
        this.payloads.push ({
                        type: 'HeartBeat Request',
                        data:req
                    });
        this.connection.send(JSON.stringify(metadata));
      }
    },
    stopCharging() {
      alert("Do you want to stop charging");
      var msgId = Math.floor(100000 + Math.random() * 900000);
      var cp = this.chargepoint;
      var connector = this.connector;
      var metadata = {
                        msgType:"2",
                        UniqueId:msgId,
                        title:"StopTransactionRequest",
                        payload:{
                          chargepoint:cp,
                          connector:connector,
                          idTag: "567890",
                          meterStop: "3333",
                          transactionId:"32434",
                          reason: "Local", 
                          transactionData: {
                            timeStamp:"02-10-2020", 
                            stampledValue:{
                              context:"other",
                              format: "signedData", 
                              measurand: "Power offered", 
                              phase:"LI", 
                              location: "EV", 
                              unit :"Kwh"
                            }
                          }
                        }
                      };
       var req = JSON.stringify(metadata);
        this.payloads.push ({
                        type: 'StopTransaction Request',
                        data:req
                    });
      this.connection.send(JSON.stringify(metadata));
      this.flag = 0;
    }

  }
}
    
</script>
