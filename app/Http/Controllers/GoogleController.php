<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;

class GoogleController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        $user = Socialite::driver('google')->user();
        // dd($user);
        $findUser = User::where('id_google', $user->getId())->first();

        $user_id = \Hashids::encode($user->id);
        if ($findUser) {
            Auth::login($findUser);
            return redirect('/manager_home');
        } else {
            $newUser = User::create([
                'name' => $user->name,
                'email' => $user->getEmail(),
                'referral_code' =>$user_id,
                'id_google' => $user->id
            ]);
            Auth::login($newUser);
            return redirect()->route('isi_data_diri');
        }  
    }
}
