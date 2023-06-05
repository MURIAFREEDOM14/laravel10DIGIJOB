<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ReferralController extends Controller
{
    public function user_referral() : response
    {
        $userId = auth()->id();

        $hashedUserId = \Hashids::encode($userId);

        return response()->view('/home',['hashedUserId'=>$hashedUserId]);
    }

}
