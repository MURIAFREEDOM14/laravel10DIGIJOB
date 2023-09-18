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
    public function sendEmail()
    {
        Mail::mailer('payment')->to('muriafreedom@gmail.com')->send(new GeneralEmail('muria','Hello','Check Email','prototype@gmail.com'));
        return 'sent';
    }
}
