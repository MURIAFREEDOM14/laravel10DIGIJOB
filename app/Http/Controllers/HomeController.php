<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Mail\DemoMail;
use App\Models\User;
use App\Models\Kandidat;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use RealRashid\SweetAlert\Facades\Alert;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth','verified']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index() : view
    {
        return view('isi_data_diri');
    }

    public function adminHome() : view
    {
        return view('admin_home');
    }

    public function managerHome()
    {
        // if(Auth::user()->type == 3){
        //     return redirect()->route('manager');
        // } elseif(Auth::user()->type == 2) {
        //     return redirect()->route('perusahaan');
        // } elseif(Auth::user()->type == 1){
        //     return redirect()->route('akademi');
        // } else {
        //     return redirect()->route('kandidat');
        // }
    }

    public function layouts()
    {
        $kandidat = Kandidat::where('referral_code')->first();
    }

    // public function dalam_negeri() : view
    // {
    //     $userId = auth()->id();
    //     $hashedUserId = \Hashids::encode($userId);

    //     $kandidat = Kandidat::where('type','=',0)->get();
    //     return view('Kandidat/dalam_negeri', ['kandidat'=>$kandidat,'user_referral'=>$hashedUserId]);
    // }

    // public function luar_negeri() : view
    // {
    //     $kandidat = Kandidat::where('penempatan','=',"luar negeri")->get();
    //     return view('Kandidat/luar_negeri',['kandidat'=>$kandidat]);
    // }
}
