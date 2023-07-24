<?php

namespace App\Http\Controllers;

use App\Events\StartVideoChat;
use App\Mail\Noreply;
use App\Models\Kandidat;
use App\Models\Kecamatan;
use App\Models\Negara;
use App\Models\Kota;
use App\Models\Provinsi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use App\Services\SlidingCaptcha;
use Storage;
use Twilio\Rest\Client;

class PrototypeController extends Controller
{
    public function test()
    {
        $prov = Provinsi::get();
        return view('prototype/prototype',compact('prov'));
    }

    public function select(Request $request)
    {
        $data = Kota::where('provinsi_id',$request->id)->get();
        return response()->json($data);
    }

    // public function select1(Request $request)
    // {
    //     $data = Kota::where('provinsi_id',$request->id)->get();
    //     return response()->json($data);
    // }

    public function create()
    {
        return view('prototype/proto_create');
    }

    public function edit($id)
    {
        return view('prototype/proto_edit');
    }

    public function delete()
    {

    }

    public function email()
    {
        $pengirim = [
            $email = "strikefreedomfalken14@gmail.com",
            $isi = "hello Freedom",
        ];
        Mail::to($email)->send(new Noreply($pengirim));
        return redirect('/prototype')->with('success',"TERKIRIM");
    }

    public function cek(Request $request)
    {
        dd($request);
    }

    public function captcha()
    {
        $sc = new SlidingCaptcha(new ImageManager);

        session()->put('sc_position', $sc->position);

        return view('prototype/prototype')->withSlidingCaptcha($sc);
    }

    public function makeCaptcha(Request $request)
    {
        $this->validate($request, [
            'guess' => ['required', Rule::in([session('sc_position')])],
        ],[
            'guess.in' => 'The puzzle must be aligned exactly'
        ]);
    }

    public function takePhoto()
    {
        return view('prototype/webcam');
    }

    public function store(Request $request)
    {
        $img = $request->image;
        $folderPath = "uploads/";

        $image_parts = explode(";base64", $img);
        $image_type_aux = explode("image/", $image_parts[0]);
        $image_type = $image_type_aux[1];

        $image_base64 = base64_decode($image_parts[1]);
        $fileName = uniqid() . '.png';

        $file = $folderPath . $fileName;
        Storage::put($file, $image_base64);

        dd('image upload successfully' .$fileName);
    }

    public function callingUser(Request $request)
    {
        $data[] = $request->to_call;
        $data['signalData'] = $request->signal_data;
        $data['from'] = Auth::id();
        $data['type'] = 'incomingCall';
        broadcast(new StartVideoChat($data))->toOthers();
        dd('Hello world');
    }

    public function confirmCalling(Request $request)
    {
        $data['signal'] = $request->signal;
        $data['to'] = $request->to;
        $data['type'] = 'callAccepted';
        broadcast(new StartVideoChat($data))->toOthers();
        dd('Hello World');
    }

    public function sendSMS(Request $request)
    {
        $input = $request->all();
        // // Required if your environment does not handle autoloading
        // require __DIR__ . '/../vendor/autoload.php';

        // Your Account SID and Auth Token from console.twilio.com
        $sid = "ACb06a8933697ab7c78fb43bcb61277dda";
        $token = "bb18df3cb8e369ee635189c9fd3e0a22";

        $client = new Client($sid, $token);
        // Use the Client to make requests to the Twilio REST API
        $message = $client->messages->create(
            // The number you'd like to send the message to
            $input['telp'],
            [
                // A Twilio phone number you purchased at https://console.twilio.com
                'from' => '+12294045420',
                // The body of the text message you'd like to send
                'body' => "P"
            ]
        );
    dd($message);
    }
}