<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\notifyAkademi;
use App\Models\notifyKandidat;
use App\Models\notifyPerusahaan;
use App\Models\messageAkademi;
use App\Models\messageKandidat;
use App\Models\messagePerusahaan;
use App\Models\ContactUs;
use App\Models\ContactUsKandidat;
use App\Models\ContactUsPerusahaan;
use App\Models\ContactUsAkademi;
use App\Models\Perusahaan;
use App\Models\Akademi;
use App\Models\Kandidat;

class NoreplyController extends Controller
{
    public function noreply()
    {
        $user = Auth::user();
        $manager = User::where('type',3)->first();
        return view('manager/noreply/noreply',compact('manager'));
    }
}
