
/*var express = require('express');
var app     = express();
app.listen('8080');

console.log('Your node server start....');

exports = module.exports = app;*/

/*var server = require('ws').Server;
var s = new server({port:8080});
s.on('connection', function(ws) {
    console.log('connected');
    ws.on('message', function(message) {
        console.log('Received:', +message);
        ws.send(message);

    });
    ws.on('close', function(message) {
        console.log('connection closeddd');
        ws.send(message);

    });
    console.log('one more charge point connected')
});*/

/*const express = require('express');
const WebSocket = require('ws');

const app = express();
const port = 8080;

app.get('/', function(req, res, next) {
  return res.send('Hello World!');
});

const wss = new WebSocket.Server({ server: app });

wss.on('connection', function connection(ws) {
    console.log('connected');
  ws.on('message', function incoming(message) {
    console.log('received: %s', message);
  });
s});

wss.on('close', function(message) {
        console.log('connection closeddd');
        ws.send(message);

    });

app.listen(port, function(err) {
  if (err) {
    throw err;
  }const express = require('express');
const WebSocket = require('ws');

const app = express();
const port = 8080;

app.get('/', function(req, res, next) {
  return res.send('Hello World!');
});

const wss = new WebSocket.Server({ server: app });

wss.on('connection', function connection(ws) {
    console.log('connected');
  ws.on('message', function incoming(message) {
    console.log('received: %s', message);
  });
s});

wss.on('close', function(message) {
        console.log('connection closeddd');
        ws.send(message);

    });

app.listen(port, function(err) {
  if (err) {
    throw err;
  }
  console.log(`listening on port ${port}!`);
});
  console.log(`listening on port ${port}!`);
});*/
const express = require('express');
const WebSocket = require('ws');
const http = require('http');

const app = express();
const port = 5001;

const server = http.createServer(app);

app.get('/', function(req, res, next) {
    return res.send('Hello Workkld!');
});

const wss = new WebSocket.Server({ server });

wss.on('connection', function connection(ws) {
    ws.on('message', function incoming(message) {
        //console.log('received: %s', message);
        var msg = JSON.parse(message);
        /*if(msg.title=="bootNotificationRequest"){
            console.log('booottt');
        }*/
        switch (msg.title) {
          case "BootNotificationRequest":
            var data = BootNotification();
            ws.send(data);
            console.log('booottt');
            break;
          case "AuthenticateRequest":
            console.log('authentication');
            var data = authentication();
            ws.send(data);
            break;
           case "StartTransactionRequest":
            console.log('StartTransaction');
            
            var data = StartTransaction();
            ws.send(data);
            break;
           case "MeterValuesRequest":
            console.log('MeterValues');
            var data = MeterValues();
            ws.send(data);
            break;
            case "HeartBeatRequest":
            console.log('HeartBeat');
            var data = HeartBeat();
            ws.send(data);
            break;
            case "StopTransactionRequest":
            console.log('StopTransaction');
            var data = StopTransaction();
            ws.send(data);
            break;
            default:
            var text = "No value found";
            break;
        }
    });
    function BootNotification(){
        var metadata = { 
                            MessageTypeId:"3",
                            UniqueId:"746832",
                            title:"BootNotificationResponse",
                            payload:{
                                status:"Accepted",
                                currenTime:"2020-12-12T02:58:57.8892785Z",
                                interval:"2"
                            }
                        };
        return JSON.stringify(metadata);
        //ws.send(JSON.stringify(metadata));
    }
    function authentication() {
        var metadata = {
                            MessageTypeId:"3",
                            Uniqueid:"456378",
                            title:"AuthenticateResponse",
                            payload:{
                                status:"Accepted",
                                expiryDate:"2021-3-8T3.00PM",
                                parentIdTag:567890
                            }
                        };
        //ws.send(JSON.stringify(metadata));
        return JSON.stringify(metadata);
    }
    function StartTransaction() {
        var metadata = {
                            MessageTypeId:"3",
                            UniqueId:"678534",
                            title:"StartTransactionResponse",
                            payload:{
                                TransactionId: "1",
                                IdTagInfo:{
                                    name:"asas",
                                    model:"ddss342",
                                    charging_time:"45min",
                                    charging_pin_id:"438"
                                }
                            }
                        };
        //ws.send(JSON.stringify(metadata));
        return JSON.stringify(metadata);
    }
    function MeterValues(){
        var metadata =  {
                            MessagetypeId:"3",
                            UniqueId:"342337",
                            title:"MeterValuesResponse",
                            payload:[]
                        };
        //ws.send(JSON.stringify(metadata));
        return JSON.stringify(metadata);
    }
    function HeartBeat() {
        var metadata =  {
                            MessagetypeId:"3",
                            UniqueId:"334741",
                            title:"HeartBeatResponse",
                            payload:{
                                currentTime: "2013-02-01T15:09:18Z" 
                            }
                        };
        //ws.send(JSON.stringify(metadata));
        return JSON.stringify(metadata);
    }
    function StopTransaction() {
        var metadata = {
                            MessageTypeId:"3",
                            UniqueId:"754557",
                            title:"StopTransactionResponse",
                            Status:"2"
                        };
        //ws.send(JSON.stringify(metadata));
        return JSON.stringify(metadata);
    }
    ws.send('something from server');
});

wss.on('close', function(message) {
        console.log('connection closeddd');
        ws.send("closed");

});


server.listen(port, function(err) {
    if (err) {
        throw err;
    }
    console.log(`listening on port ${port}!`);
});