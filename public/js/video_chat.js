const webSocket = new WebSocket("ws://127.0.0.1:8000")

let name
function sendName() {
    name = document.getElementById("name_input").value
    sendData({
        type: "store_user"
    })
}

function sendData(data) {
    data.name = name
    webSocket.send(JSON.stringify(data))
}

let localStream
let peerConn
function startCall() {
    document.getElementById("video-call-div").style.display = "inline";
    navigator.getUserMedia({
        video: {
            frameRate : 24,
            width: {
                min: 480, ideal: 720, max: 1280
            },
            aspectRatio: 1.33333
        },
        audio: true
    }, (stream) => {
        localStream = stream
        document.getElementById("local-video").srcObject = locals
        let configuration = {
            iceServers: [
                
            ]
        }
        
        peerConn = new RTCPeerConnection()
    }, (error) => {
        console.log(error);
    })
}