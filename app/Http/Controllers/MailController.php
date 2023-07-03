<?php

namespace App\Http\Controllers;

use App\Mail\GeneralEmail;
use Illuminate\Http\Request;
// use Mail;
use App\Mail\DemoMail;
use App\Http\Requests\ReferralRequest;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();
        $kirim_email = $request->kirim_email;
        $referral_link = auth()->user()->referral_link;

        $userId = auth()->id();
        $user_referral = \Hashids::encode($userId);

        $pengirim = [
            'pengirim' => $user->name,
            'referral_link' => $referral_link,
            'user_referral' => $user_referral
        ];

        // $mailData = [
        //     'title' => 'Mail from portal.com',
        //     'body' => 'This is for testing email using smtp'
        // ];
        
        try {

            Mail::to($kirim_email)->send(new DemoMail($pengirim));
            return response([
                'message' => 'email terkirim',
            ], 201);
        }
        catch (\Exception $ex) {
            return response([
                'gagal kirim email >_<'. $ex->getMessage()
            ], 402);
        }

    }

    public function transfer()
    {
        $user = auth()->user();
        
    }

    public function sendEmail()
    {
        Mail::mailer('payment')->to('muriafreedom@gmail.com')->send(new GeneralEmail('muria','Hello','Check Email','prototype@gmail.com'));
        return 'sent';
    }
}
