
var mysql = require('mysql');
const fsPromises = require("fs").promises;
var fs = require('fs');
const express = require('express');
const WebSocket = require('ws');
const http = require('http');
const  axios  = require('axios');

const app = express();
const port = 7000;

const server = http.createServer(app);

app.get('/', function(req, res, next) {
    return res.send('Hello Workked!');
});

const dir = '../public/Jsonfiles'

try {
  if (!fs.existsSync(dir)){
    fs.mkdirSync(dir)
  }
} catch (err) {
  console.error(err)
}

(async () => {
  try {
    const { fd } = await fsPromises.open("../public/Jsonfiles", "r");
    fs.fchmod(fd, 0o777, err => {
      if (err) throw err;
      console.log("File permission change succcessful");
    });
  } catch (error) {
    console.log(error);
  }
})();

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
            console.log('boot');
            BootNotification(msg);
            //console.log(res);
            //ws.send(res);
            
            break;
          case "AuthenticateRequest":
            console.log('authentication');
            authentication(msg);
            break;
           case "StartTransactionRequest":
            console.log('StartTransaction');
            StartTransaction(msg);
            break;
           case "MeterValuesRequest":
            console.log('MeterValues');
            MeterValues(msg);
            break;
            case "HeartBeatRequest":
            console.log('HeartBeat');
            HeartBeat(msg);
            break;
            case "StopTransactionRequest":
            console.log('StopTransaction');
            StopTransaction(msg);
            break;
            default:
            var text = "No value found";
            break;
        }
    });
    var date = new Date();
    var date1 = date.getFullYear()+'-'+(date.getMonth()+1)+'-'+date.getDate();
    var time = date.getHours() + ":" + date.getMinutes() + ":" + date.getSeconds();
    var datetime = date1+' '+time;
    console.log(datetime);
    function BootNotification(msg){
        /*var data={
                    MessageTypeId:"2",
                    UniqueId:"746832",
                    title:"BootNotification",
                    data:{
                        chargePointVendor:"Point1",
                        chargePointModel:"Model1",
                        chargePointSerialNumber:"CP1234",
                        chargeBoxSerialNumber:"CB1234",
                        firmwareVersion:"v1",
                        iccid:"1111",
                        imsi:"2222",
                        meterType:"metertype1",
                        meterSerialNumber:"MTR1234"
                        }
                  };*/
          var data = msg;
          var chargepoint = data.payload.chargePointVendor;
          var connector = data.payload.connector;
        var bootrequest=Math.random().toString(36).substring(2, 15) + Math.random().toString(36).substring(2, 15);
        fs.writeFile('../public/Jsonfiles/'+bootrequest+'.json', JSON.stringify(msg, null, 4), function(err){
          console.log('Json file generated succesfully .Check your project public/Jsonfiles folder');
          }); 
        var con = mysql.createConnection({
          host: "localhost",
          user: "root",
          password: "",
          database: "larasocket"
        });
        let req_file = {
                cp_id :chargepoint,
                connector_id: connector,
                type : '0',
                file_path :'../public/Jsonfiles/'+bootrequest+'.json',
                created_at: date,
                updated_at: date
          };
          con.query('INSERT INTO msg_files SET ?', req_file, function(error, results, fields) {
              if (error) throw error;
              console.log("request"+results.insertId);
          });
          //var data = msg;
        var cbserialno=data.payload.chargeBoxSerialNumber;
        var cpserialno=data.payload.chargePointSerialNumber;
        var chargepoint = data.payload.chargePointVendor;
        var connector = data.payload.connector;
        var cpstatus="0";
        var con = mysql.createConnection({
          host: "localhost",
          user: "root",
          password: "",
          database: "larasocket"
        });
        var queryString = "SELECT * FROM chargepoint WHERE CB_Serial_No= ? AND CP_Serial_No= ?;"
        var filter = [cbserialno,cpserialno];
        //var filter = [cbserialno,cpserialno,cpstatus];
        //var cp = "SELECT CP_ID FROM chargepoint WHERE CB_Serial_No= ? AND CP_Serial_No= ? AND CP_Status= ?;"
        con.query(queryString, filter, function(err, results) {
           //console.log(results);
           var querystr = "SELECT * FROM cp_connector WHERE cp_id=? AND connector_type=? AND status=?;"
          var filter1 = [chargepoint, connector,cpstatus] ;
          con.query(querystr, filter1, function(err, results1) {

            console.log(results1);
            if(results == "" && results1 ==" ")
            {
              console.log('Rejected');
              var metadata = { 
                                MessageTypeId:"3",
                                UniqueId:"746832",
                                title:"BootNotificationResponse",
                                payload:{
                                      status:"Rejected",
                                      currenTime:date,
                                      interval:"2"
                                  }
                              };
              var bootresponse=Math.random().toString(36).substring(2, 15) + Math.random().toString(36).substring(2, 15);
              fs.writeFile('../public/Jsonfiles/'+bootresponse+'.json', JSON.stringify(metadata, null, 4), function(err){
                console.log('Json file generated succesfully .Check your project public/Jsonfiles folder');
              });

              let file = {
                cp_id :chargepoint,
                connector_id: connector,
                type : '1',
                file_path :'../public/Jsonfiles/'+bootresponse+'.json',
                created_at: date,
                updated_at: date
              };

              con.query('INSERT INTO msg_files SET ?', file, function(error, results, fields) {
                if (error) throw error;
                console.log(results.insertId);
              });

              //return(metadata);
              ws.send(JSON.stringify(metadata));
              //return JSON.stringify(metadata);
            }
            else {
              console.log('Accepted');
              var queryString = "UPDAte cp_connector SET status = '1' WHERE cp_id= ? AND connector_type= ? AND status= ?;"
              var filter = [chargepoint,connector,cpstatus];
              con.query(queryString, filter, function(err, results) {
                console.log('Updated');
              });
              var metadata = { 
                          MessageTypeId:"3",
                          UniqueId:"746832",
                          title:"BootNotificationResponse",
                          payload:{
                                status:"Accepted",
                                currenTime:date,
                                interval:"2"
                            }
                        };
              var bootresponse=Math.random().toString(36).substring(2, 15) + Math.random().toString(36).substring(2, 15);
              fs.writeFile('../public/Jsonfiles/'+bootresponse+'.json', JSON.stringify(metadata, null, 4), function(err){
              console.log('Json file generated succesfully .Check your project public/Jsonfiles folder');
              });


              let file = {
                cp_id :chargepoint,
                connector_id: connector,
                type : '1',
                file_path :'../public/Jsonfiles/'+bootresponse+'.json',
                created_at: date,
                updated_at: date
              };

              con.query('INSERT INTO msg_files SET ?', file, function(error, results, fields) {
                if (error) throw error;
                console.log(results.insertId);
              });
              
              ws.send(JSON.stringify(metadata));
            }
          });
        });
        /*
        return JSON.stringify(metadata);*/
        
    }
    function authentication(msg) {
        /*var data={
                    msgType: 2,
                    uniqueId:msgId,
                    title: "AuthenticateRequest",
                    payload: {
                      idTag:IdTag
                    }
                  };*/
        var data = msg;
        var chargepoint = data.payload.chargepoint;
        var connector = data.payload.connector;
        var authrequest=Math.random().toString(36).substring(2, 15) + Math.random().toString(36).substring(2, 15);
        fs.writeFile('../public/Jsonfiles/'+authrequest+'.json', JSON.stringify(data, null, 4), function(err){
          console.log('Json file generated succesfully .Check your project public/Jsonfiles folder');
        });
        var con = mysql.createConnection({
          host: "localhost",
          user: "root",
          password: "",
          database: "larasocket"
        });
        let req_file = {
                cp_id :chargepoint,
                connector_id: connector,
                type : '0',
                file_path :'../public/Jsonfiles/'+authrequest+'.json',
                created_at: date,
                updated_at: date
          };
          con.query('INSERT INTO msg_files SET ?', req_file, function(error, results, fields) {
              if (error) throw error;
              console.log("request"+results.insertId);
          });
          var idtag=data.payload.idTag;
          var con = mysql.createConnection({
            host: "localhost",
            user: "root",
            password: "",
            database: "larasocket"
          });
          var sql = 'SELECT * FROM customers WHERE User_ID = ' + mysql.escape(idtag);
          con.query(sql, function (err, result) {
            if (err) throw err;
            if(result == "")
            {
              console.log('Invalid');
              var metadata = {
                MessageTypeId:"3",
                Uniqueid:"456378",
                title:"AuthenticateResponse",
                payload:{
                    expiryDate:"2021-3-8T3.00PM",
                    parentIdTag:"170443",
                    status:"Invalid"
                }
            };
              var authresponse=Math.random().toString(36).substring(2, 15) + Math.random().toString(36).substring(2, 15);
              fs.writeFile('../public/Jsonfiles/'+authresponse+'.json', JSON.stringify(metadata, null, 4), function(err){
                console.log('Json file generated succesfully .Check your project public/Jsonfiles folder');
              });
              let file = {
                cp_id :chargepoint,
                connector_id: connector,
                type : '1',
                file_path :'../public/Jsonfiles/'+authresponse+'.json',
                created_at: date,
                updated_at: date
              };

              con.query('INSERT INTO msg_files SET ?', file, function(error, results, fields) {
                if (error) throw error;
                console.log(results.insertId);
              });
              //return JSON.stringify(metadata);
              ws.send(JSON.stringify(metadata));
            }
            else {
                    console.log('Accepted');
                    var metadata = {
                      MessageTypeId:"3",
                      Uniqueid:"456378",
                      title:"AuthenticateResponse",
                      payload:{
                          expiryDate:"2021-3-8T3.00PM",
                          parentIdTag:"170443",
                          status:"Accepted"
                      }
                  };
                    var authresponse=Math.random().toString(36).substring(2, 15) + Math.random().toString(36).substring(2, 15);
                    fs.writeFile('../public/Jsonfiles/'+authresponse+'.json', JSON.stringify(metadata, null, 4), function(err){
                      console.log('Json file generated succesfully .Check your project public/Jsonfiles folder');
                    });
                    let file = {
                        cp_id :chargepoint,
                        connector_id: connector,
                        type : '1',
                        file_path :'../public/Jsonfiles/'+authresponse+'.json',
                        created_at: date,
                        updated_at: date
                    };

                    con.query('INSERT INTO msg_files SET ?', file, function(error, results, fields) {
                      if (error) throw error;
                      console.log(results.insertId);
                    });
              //return JSON.stringify(metadata);
              ws.send(JSON.stringify(metadata));
  
            }
          });

    }
    function StartTransaction(msg) {
        /*var data={
                    MessageTypeId:"2",
                    UniqueId:"678534",
                    title:"StartTransaction",
                    payload:{
                            connectorId: "1",
                            idTag: "170443",
                            meterStart: "2222",
                            reservationId:"32434",
                            timestamp:date
                    }
                          
                  };*/
        var data = msg;
        var chargepoint = data.payload.chargepoint;
        var connector = data.payload.connectorId;
        var startrequest=Math.random().toString(36).substring(2, 15) + Math.random().toString(36).substring(2, 15);
        fs.writeFile('../public/Jsonfiles/'+startrequest+'.json', JSON.stringify(data, null, 4), function(err){
          console.log('Json file generated succesfully .Check your project public/Jsonfiles folder');
        });
        var con = mysql.createConnection({
          host: "localhost",
          user: "root",
          password: "",
          database: "larasocket"
        });
        let req_file = {
                cp_id :chargepoint,
                connector_id: connector,
                type : '0',
                file_path :'../public/Jsonfiles/'+startrequest+'.json',
                created_at: date,
                updated_at: date
          };
          con.query('INSERT INTO msg_files SET ?', req_file, function(error, results, fields) {
              if (error) throw error;
              console.log("request"+results.insertId);
          });
          var connectorid=data.payload.connectorId;
          var con = mysql.createConnection({
            host: "localhost",
            user: "root",
            password: "",
            database: "larasocket"
          });
        var sql = 'SELECT * FROM connectortype WHERE id = ' + mysql.escape(connectorid);
        con.query(sql, function (err, result) {
          if (err) throw err;
          if(result == "")
          {
            console.log('Invalid')
            var metadata = {
                MessageTypeId:"3",
                UniqueId:"678534",
                title:"StartTransactionResponse",
                IdTagInfo:{
                  expiryDate:"2021-3-8T3.00PM",
                  parentIdTag:"170443",
                  status:"Invalid"
                },
                transactionId:"2468"
                
            };
          
            var startresponse=Math.random().toString(36).substring(2, 15) + Math.random().toString(36).substring(2, 15);
            fs.writeFile('../public/Jsonfiles/'+startresponse+'.json', JSON.stringify(metadata, null, 4), function(err){
              console.log('Json file generated succesfully .Check your project public/Jsonfiles folder');
            });
            let file = {
                cp_id :chargepoint,
                connector_id: connector,
                type : '1',
                file_path :'../public/Jsonfiles/'+startresponse+'.json',
                created_at: date,
                updated_at: date
              };

              con.query('INSERT INTO msg_files SET ?', file, function(error, results, fields) {
                if (error) throw error;
                console.log(results.insertId);
              });
              ws.send(JSON.stringify(metadata));
            }
           else {
            console.log('Accepted')
                  var metadata = {
                    MessageTypeId:"3",
                            UniqueId:"678534",
                            title:"StartTransactionResponse",
                            IdTagInfo:{
                              expiryDate:"2021-3-8T3.00PM",
                              parentIdTag:"170443",
                              status:"Accepted"
                           },
                            transactionId:"2468"
                          };
                          
                  var startresponse=Math.random().toString(36).substring(2, 15) + Math.random().toString(36).substring(2, 15);
                  fs.writeFile('../public/Jsonfiles/'+startresponse+'.json', JSON.stringify(metadata, null, 4), function(err){
                    console.log('Json file generated succesfully .Check your project public/Jsonfiles folder');
                  }); 
                  let file = {
                    cp_id :chargepoint,
                    connector_id: connector,
                    type : '1',
                    file_path :'../public/Jsonfiles/'+startresponse+'.json',
                    created_at: date,
                    updated_at: date
                  };

                  con.query('INSERT INTO msg_files SET ?', file, function(error, results, fields) {
                    if (error) throw error;
                    console.log(results.insertId);
                  });
              ws.send(JSON.stringify(metadata));
           }
        });
        /*var metadata = {
                            MessageTypeId:"3",
                            UniqueId:"678534",
                            title:"StartTransactionResponse",
                            IdTagInfo:{
                              expiryDate:"2021-3-8T3.00PM",
                              parentIdTag:"170443",
                              status:"Accepted"
                           },
                            transactionId:"2468"
                          
                        };
        return JSON.stringify(metadata);*/
    }
    function MeterValues(msg){
        /*var data={
                    MessageTypeId:"2",
                    UniqueId:"342337",
                    title:"MeterValues",
                    data:{
                            connectorId:"1",
                            transactionId:"32434",
                            meterValue:{
                                          timeStamp:date,
                                          sampledValue:{
                                                          context:"other",
                                                          format:"signedData",
                                                          measurand:"Power offered",
                                                          phase:"LI",
                                                          location:"EV",
                                                          unit:"Kwh"
                                                        }
                                        }
                            
                          }
                  };*/
        var data = msg;
        var chargepoint = data.payload.chargepoint;
        var connector = data.payload.connectorId;
        var meterrequest=Math.random().toString(36).substring(2, 15) + Math.random().toString(36).substring(2, 15);
        fs.writeFile('../public/Jsonfiles/'+meterrequest+'.json', JSON.stringify(data, null, 4), function(err){
          console.log('Json file generated succesfully .Check your project public/Jsonfiles folder');
        });
        var con = mysql.createConnection({
          host: "localhost",
          user: "root",
          password: "",
          database: "larasocket"
        });
        let req_file = {
                cp_id :chargepoint,
                connector_id: connector,
                type : '0',
                file_path :'../public/Jsonfiles/'+meterrequest+'.json',
                created_at: date,
                updated_at: date
          };
          con.query('INSERT INTO msg_files SET ?', req_file, function(error, results, fields) {
              if (error) throw error;
              console.log("request"+results.insertId);
          });
        var connectorid=data.payload.connectorId;
        var con = mysql.createConnection({
          host: "localhost",
          user: "root",
          password: "",
          database: "larasocket"
        });
        if(connectorid == "1")
        {
          con.connect(function(err) {
            //Insert a record in the "transcations" table:
            var sql = "INSERT INTO transaction (Connector_ID,CP_ID,CS_ID,User_ID,Reservation_ID,Trans_DateTime,Trans_Meter_Start,Trans_Meter_Stop) VALUES ('0','1','3459','170443','235265','"+datetime+"','45','53')";
            con.query(sql, function (err, result) {
              if (err) throw err;
              console.log("transactiondata inserted");
            });
          });
          con.connect(function(err) {
            //Insert a record in the "metervalue" table:
            var sql = "INSERT INTO meter_values (Connector_ID,CP_ID,Date,Reservation_ID,Meter_Values) VALUES ('0','1','"+datetime+"','235265','53')";
            con.query(sql, function (err, result) {
              if (err) throw err;
              console.log("metervalue record inserted");
            });
          });
          var metadata =  {
            MessagetypeId:"3",
            UniqueId:"342337",
            title:"MeterValuesResponse",
            payload:[]
         };
          var metervalueresponse=Math.random().toString(36).substring(2, 15) + Math.random().toString(36).substring(2, 15);
          fs.writeFile('../public/Jsonfiles/'+metervalueresponse+'.json', JSON.stringify(metadata, null, 4), function(err){
            console.log('Json file generated succesfully .Check your project public/Jsonfiles folder');
          });
          let file = {
                cp_id :chargepoint,
                connector_id: connector,
                type : '1',
                file_path :'../public/Jsonfiles/'+metervalueresponse+'.json',
                created_at: date,
                updated_at: date
              };

              con.query('INSERT INTO msg_files SET ?', file, function(error, results, fields) {
                if (error) throw error;
                console.log(results.insertId);
              });
          return JSON.stringify(metadata);
        }
        else {
            con.connect(function(err) {
              //Insert a record in the "trnascations" table:
              //var sql = "INSERT INTO transaction (Connector_ID,CP_ID,CS_ID,User_ID,Reservation_ID,Trans_DateTime,Trans_Meter_Start,Trans_Meter_Stop) VALUES (+connectorid+,'1','3459','170443','235265','2020-10-02 11-05-am','45','53')";
              var sql = "INSERT INTO transaction (Connector_ID,CP_ID,CS_ID,User_ID,Reservation_ID,Trans_DateTime,Trans_Meter_Start,Trans_Meter_Stop) VALUES ('1','1','3459','170443','235265','"+datetime+"','45','53')";
              con.query(sql, function (err, result) {
                if (err) throw err;
                console.log("transactiondata inserted");
              });
            });
            con.connect(function(err) {
              //Insert a record in the "metervalue" table:
             // var sql = "INSERT INTO meter_values (Connector_ID,CP_ID,Date,Reservation_ID,Meter_Values) VALUES (+connectorid+,'1','2020-10-02 11-05-am','235265','53')";
              var sql = "INSERT INTO meter_values (Connector_ID,CP_ID,Date,Reservation_ID,Meter_Values) VALUES ('1','1','"+datetime+"','235265','53')";
              con.query(sql, function (err, result) {
                if (err) throw err;
                console.log("metervalue record inserted");
              });
            });
            var metadata =  {
              MessagetypeId:"3",
              UniqueId:"342337",
              title:"MeterValuesResponse",
              payload:[]
          };
          var metervalueresponse=Math.random().toString(36).substring(2, 15) + Math.random().toString(36).substring(2, 15);
          fs.writeFile('../public/Jsonfiles/'+metervalueresponse+'.json', JSON.stringify(metadata, null, 4), function(err){
            console.log('Json file generated succesfully .Check your project public/Jsonfiles folder');
          });
          let file = {
                cp_id :chargepoint,
                connector_id: connector,
                type : '1',
                file_path :'../public/Jsonfiles/'+metervalueresponse+'.json',
                created_at: date,
                updated_at: date
              };

              con.query('INSERT INTO msg_files SET ?', file, function(error, results, fields) {
                if (error) throw error;
                console.log(results.insertId);
              });
            return JSON.stringify(metadata);
        }
        /*var metadata =  {
                            MessagetypeId:"3",
                            UniqueId:"342337",
                            title:"MeterValuesResponse",
                            payload:[]
                        };*/
       
        // var metervalueresponse=Math.random().toString(36).substring(2, 15) + Math.random().toString(36).substring(2, 15);
        // fs.writeFile('../public/Jsonfiles/'+metervalueresponse+'.json', JSON.stringify(metadata, null, 4), function(err){
        // console.log('Json file generated succesfully .Check your project public/Jsonfiles folder');
        // });
         /*return JSON.stringify(metadata);*/
    }
    function HeartBeat(msg) {
        /*var data={
                    MessageTypeId:"2",
                    UniqueId:"334741",
                    title:"Heartbeat",
                    data:[]
                  };*/
        var data = msg;
        var chargepoint = data.payload.chargepoint;
        var connector = data.payload.connector;
        var heartbeatrequest=Math.random().toString(36).substring(2, 15) + Math.random().toString(36).substring(2, 15);
        fs.writeFile('../public/Jsonfiles/'+heartbeatrequest+'.json', JSON.stringify(data, null, 4), function(err){
          console.log('Json file generated succesfully .Check your project public/Jsonfiles folder');
          });
        var con = mysql.createConnection({
          host: "localhost",
          user: "root",
          password: "",
          database: "larasocket"
        });
        let req_file = {
                cp_id :chargepoint,
                connector_id: connector,
                type : '0',
                file_path :'../public/Jsonfiles/'+heartbeatrequest+'.json',
                created_at: date,
                updated_at: date
          };
          con.query('INSERT INTO msg_files SET ?', req_file, function(error, results, fields) {
              if (error) throw error;
              console.log("request"+results.insertId);
          });
        var metadata =  {
                            MessagetypeId:"3",
                            UniqueId:"334741",
                            title:"HeartBeatResponse",
                            payload:{
                                currentTime:date 
                            }
                        };
        //ws.send(JSON.stringify(metadata));
       
        var heartbeatresponse=Math.random().toString(36).substring(2, 15) + Math.random().toString(36).substring(2, 15);
        fs.writeFile('../public/Jsonfiles/'+heartbeatresponse+'.json', JSON.stringify(metadata, null, 4), function(err){
          console.log('Json file generated succesfully .Check your project public/Jsonfiles folder');
        });
        let file = {
                cp_id :chargepoint,
                connector_id: connector,
                type : '1',
                file_path :'../public/Jsonfiles/'+heartbeatresponse+'.json',
                created_at: date,
                updated_at: date
              };

              con.query('INSERT INTO msg_files SET ?', file, function(error, results, fields) {
                if (error) throw error;
                console.log(results.insertId);
              });
         return JSON.stringify(metadata);
    }
    function StopTransaction(msg) {
      
      var data = msg;
      var chargepoint = data.payload.chargepoint;
      var connector = data.payload.connector;
      var stoprequest=Math.random().toString(36).substring(2, 15) + Math.random().toString(36).substring(2, 15);
      fs.writeFile('../public/Jsonfiles/'+stoprequest+'.json', JSON.stringify(data, null, 4), function(err){
        console.log('Json file generated succesfully .Check your project public/Jsonfiles folder');
      });
      var con = mysql.createConnection({
          host: "localhost",
          user: "root",
          password: "",
          database: "larasocket"
        });
        let req_file = {
                cp_id :chargepoint,
                connector_id: connector,
                type : '0',
                file_path :'../public/Jsonfiles/'+stoprequest+'.json',
                created_at: date,
                updated_at: date
          };
          con.query('INSERT INTO msg_files SET ?', req_file, function(error, results, fields) {
              if (error) throw error;
              console.log("request"+results.insertId);
          });
      var reason=data.payload.reason;
      // var metervalue=data.meterStop;
      var con = mysql.createConnection({
        host: "localhost",
        user: "root",
        password: "",
        database: "larasocket"
      });
      if(reason == "Local")
      {
        con.connect(function(err) {
          //Insert a record in the "trnascations" table:
          var sql = "INSERT INTO transaction (Connector_ID,CP_ID,CS_ID,User_ID,Reservation_ID,Trans_DateTime,Trans_Meter_Start,Trans_Meter_Stop) VALUES ('0','1','3459','170443','235265','"+datetime+"','45','103')";
          con.query(sql, function (err, result) {
            if (err) throw err;
            console.log("transactiondata inserted");
          });
        });
        con.connect(function(err) {
          //Insert a record in the "metervalue" table:
          var sql = "INSERT INTO meter_values (Connector_ID,CP_ID,Date,Reservation_ID,Meter_Values) VALUES ('0','1','"+datetime+"','235265','103')";
          con.query(sql, function (err, result) {
            if (err) throw err;
            console.log("metervalue record inserted");
          });
        });

        var cpstatus="1";
        var queryString1 = "UPDAte cp_connector SET status = '0' WHERE cp_id= ? AND connector_type=? AND status=?;"
        var filter1 = [chargepoint,connector,cpstatus];
        con.query(queryString1, filter1, function(err, results) {
          console.log('updated...CP ready');
        });


        var metadata = {
          MessageTypeId:"3",
          UniqueId:"754557",
          title:"StopTransactionResponse",
            payload :{
                        expiryDate:"2021-3-8T3.00PM",
                        parentIdTag:"170443",
                        status:"Accepted"
            }
          // Status:"2"
          };
         var stopresponse=Math.random().toString(36).substring(2, 15) + Math.random().toString(36).substring(2, 15);
        fs.writeFile('../public/Jsonfiles/'+stopresponse+'.json', JSON.stringify(metadata, null, 4), function(err){
          console.log('Json file generated succesfully .Check your project public/Jsonfiles folder');
        });
        let file = {
                cp_id :chargepoint,
                connector_id: connector,
                type : '1',
                file_path :'../public/Jsonfiles/'+stopresponse+'.json',
                created_at: date,
                updated_at: date
          };

          con.query('INSERT INTO msg_files SET ?', file, function(error, results, fields) {
            if (error) throw error;
            console.log(results.insertId);
          });
        
        ws.send(JSON.stringify(metadata));
      }
      else {
        if(reason == "UnlockConnectorEVSide")
        {
          con.connect(function(err) {
            //Insert a record in the "trnascations" table:
            var sql = "INSERT INTO transaction (Connector_ID,CP_ID,CS_ID,User_ID,Reservation_ID,Trans_DateTime,Trans_Meter_Start,Trans_Meter_Stop) VALUES ('0','1','3459','170443','235265','2020-10-02 11-05-am','45','103')";
            con.query(sql, function (err, result) {
              if (err) throw err;
              console.log("transactiondata inserted");
            });
          });
          con.connect(function(err) {
            //Insert a record in the "metervalue" table:
            var sql = "INSERT INTO meter_values (Connector_ID,CP_ID,Date,Reservation_ID,Meter_Values) VALUES ('0','1','2020-10-02 11-05-am','235265','103')";
            con.query(sql, function (err, result) {
              if (err) throw err;
              console.log("metervalue record inserted");
            });
          });
          var metadata = {
            MessageTypeId:"3",
            UniqueId:"754557",
            title:"StopTransactionResponse",
            payload:{
                        expiryDate:"2021-3-8T3.00PM",
                        parentIdTag:"170443",
                        status:"Accepted"
            }
            // Status:"2"
            };
           var stopresponse=Math.random().toString(36).substring(2, 15) + Math.random().toString(36).substring(2, 15);
          fs.writeFile('../public/Jsonfiles/'+stopresponse+'.json', JSON.stringify(metadata, null, 4), function(err){
            console.log('Json file generated succesfully .Check your project public/Jsonfiles folder');
          });
          let file = {
                cp_id :chargepoint,
                connector_id: connector,
                type : '1',
                file_path :'../public/Jsonfiles/'+stopresponse+'.json',
                created_at: date,
                updated_at: date
          };

          con.query('INSERT INTO msg_files SET ?', file, function(error, results, fields) {
            if (error) throw error;
            console.log(results.insertId);
          });
        var cpid="1";
        var queryString = "UPDAte cp_connector SET CP_Status = '0' WHERE CP_ID= ?;"
        var filter = [cpid];
        con.query(queryString, filter, function(err, results) {
          console.log('CP ready');
        });
        }
        ws.send(JSON.stringify(metadata));
      }
        /*var metadata = {
                            MessageTypeId:"3",
                            UniqueId:"754557",
                            title:"StopTransactionResponse",
                            idTagInfo:{
                                        expiryDate:"2021-3-8T3.00PM",
                                        parentIdTag:"170443",
                                        status:"Accepted"
                            }
                            // Status:"2"
                        };
        return JSON.stringify(metadata);*/
    }
    //ws.send('something from server');
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