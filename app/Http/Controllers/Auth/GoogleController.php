<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }
    
    public function handleGoogleCallback()
    {
        try {
            $user = Socialite::driver('google')->user();
            $finduser = Kandidat::where('id_google', $user->getId())->first();

            if($finduser){
                Auth::login($finduser);
                return redirect()->route('laman');
            }
            else
            {
                $newUser = Kandidat::updateOrCreate(['email' => $user->email],[
                    'nama' => $user->name,
                    'id_google' => $user->id,
                    'username' => $user->username,
                    'NIK' => $user->nik,
                    'email' => $user->email,
                ]);

                Auth::login($newUser);

                return redirect()->route('laman');
            }
        }
        catch (\Exception $e){
            dd($e->getMessage());
        }
    }
}

