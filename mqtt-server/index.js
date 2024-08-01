import mqtt from 'mqtt';
let clientId = "igonio-server-client";
let username = "igonio-server";
let password = "igonio-server";

const serverClient = mqtt.connect('mqtts://b6de8b3b.ala.asia-southeast1.emqxsl.com:8883', {
    clientId,
    username,
    password,
    // ...other options
  });

  let topic_device = 'devices/#';
  serverClient.subscribe(topic_device, 0, (error)=>{
    if(error){
        console.log('Subscribe error: ', error);
        return;
    }

    console.log(`Subscribed to topic: '${topic_device}'`);
  });


  

var http = require('http');
var server = http.createServer(function(req, res) {
    res.writeHead(200, {'Content-Type': 'text/plain'});
    var message = 'It works!\n',
        version = 'NodeJS ' + process.versions.node + '\n',
        response = [message, version].join('\n');
    res.end(response);
});
server.listen();
