
// data 
const clientId = "igonio_web_client_" + Math.random().toString(16).substring(2, 8);
const username = "igonio-browser-client";
const password = "igonio-browser-client";
const brokerHost = '';
const brokerPort = '';
const brokerEndpoint = '/';
 
let client = mqtt.connect("wss://broker.emqx.io:8084/mqtt", {
    clientId,
    username,
    password,
    // ...other options
});
client.logging = true;

window._mqclient = client;

window._mqclient.on('connect', ()=>{
    if(window._mqclient.logging) console.log('MQTT: connected to broker');
});

window._mqclient.on('message', (topic, message)=>{
    if(window._mqclient.logging) console.log(`Message on: ${topic}`);
});

let matchNode = (topic, nodeSerialNumber) => {
    let topic_str = String(topic);
    return (topic_str.search(nodeSerialNumber) < 0) ? false : true;
}

let subscribeDeviceTopic = (nodeSerialNumber)=>{
    window._mqclient.on('connect', () => {
        if(window._mqclient.logging) console.log(`MQTT: subscribing to: igonio-node/${nodeSerialNumber}`);
        window._mqclient.subscribe(`igonio-node/${nodeSerialNumber}`);
    });
}


class DeviceNode{

    constructor({mqttClient, nodeSerial, onDataReceivedCallback, onOfflineCallback}){
        this._mq = mqttClient;
        this.nodeSerial = nodeSerial;
        this.mq_endpoint = `igonio-node/${this.nodeSerial}`;
        this.onDataReceivedCallback = onDataReceivedCallback;
        this.onOfflineCallback = onOfflineCallback;
        this.onlineTreshold = 10000; // ms

        this._mq.on('connect', ()=>{
            console.log(`MQTT: subscribing to: ${this.mq_endpoint}`);
            this._mq.subscribe(this.mq_endpoint);
        });

        this._mq.on('message', (topic, message)=>{
            if(this._matchNode(topic, this.nodeSerial)){
                this.imOnline();
                this.onDataReceivedCallback(message);
            }
        });

    }

    imOnline(){
        clearTimeout(this.onlineTimeout);
        this.onlineTimeout = setTimeout(() => {
            this.onOfflineCallback();
        }, this.onlineTreshold);
    }

    _getPayload(message){
        return JSON.parse(message);
    }

    _matchNode(topic, nodeSerialNumber){
        let topic_str = String(topic);
        return (topic_str.search(nodeSerialNumber) < 0) ? false : true;
    }
}

