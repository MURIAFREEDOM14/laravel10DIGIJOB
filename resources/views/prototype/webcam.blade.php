<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Document</title>
        <link rel="stylesheet" href="/css/video_chat.css">
    </head>
    <body>
        <div class="container">
            <h1 class="text-center">Laravel webcam capture image and save from camera - ItSolutionStuff.com</h1>
             
            <form method="POST" action="{{ route('webcam.capture') }}">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div id="my_camera"></div>
                        <br/>
                        <input type=button value="Take Snapshot" onClick="take_snapshot()">
                        <input type="hidden" name="image" class="image-tag">
                    </div>
                    <div class="col-md-6">
                        <input type="file" name="" id="" accept="image/*" capture="camera">
                    </div>
                    <div class="col-md-6">
                        <div id="results">Your captured image will appear here...</div>
                    </div>
                    <div class="col-md-12 text-center">
                        <br/>
                        <button class="btn btn-success">Submit</button>
                    </div>
                </div>
            </form>
            {{-- <video-chat :allusers="{{ $users }}" :authUserId="{{ auth()->id() }}" turn_url="{{ env('TURN_SERVER_URL') }}"
                turn_username="{{ env('TURN_SERVER_USERNAME') }}" turn_credential="{{ env('TURN_SERVER_CREDENTIAL') }}" /> --}}
        

            <div class="">
                <input type="text" placeholder="Your Name" name="" id="name_input"><br>
                <button onclick="sendName()">Send</button>
                <button onclick="startCall()">Start</button>
            </div>
            <div class="" id="video-call-div">
                <video id="local-video" autoplay></video>
                <video id="remote-video" autoplay></video>
                <div class="call-action-div">
                    <button onclick="muteVideo()">Mute Video</button>
                    <button onclick="muteAudio()">Mute Audio</button>
                </div>
            </div>

            
        </div>
        <script src="/js/video_chat.js"></script>
        <script language="JavaScript">
            Webcam.set({
                width: 490,
                height: 350,
                image_format: 'jpeg',
                jpeg_quality: 90
            });
            
            Webcam.attach( '#my_camera' );
            
            function take_snapshot() {
                Webcam.snap( function(data_uri) {
                    $(".image-tag").val(data_uri);
                    document.getElementById('results').innerHTML = '<img src="'+data_uri+'"/>';
                } );
            }
        </script>
    </body>
</html>