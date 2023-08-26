<?php

namespace App\Console\Commands;

use App\Models\LowonganPekerjaan;
use Illuminate\Console\Command;
use App\Models\User;
use App\Models\Jadwal;   
use App\Models\ReportNewUser;
use App\Models\ReportUserIn;

class TimeJadwal extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:time-jadwal';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function __construct(){
        parent::__construct();
    }

    public function handle()
    {        
        $reportLogin = ReportUserIn::all();
        foreach($reportLogin as $item){
            // $masuk = ReportUserIn::where('')->first();
            Jadwal::create([
                'email' => $item->email,
                'referral_code' => $item->referral_code,
                'type' => $item->type,
                'password' => $item->password,
                'status' => "login"
            ]);
        }
        $reportNew = ReportNewUser::all();
        foreach($reportNew as $item){
            Jadwal::create([
                'email' => $item->email,
                'referral_code' => $item->referral_code,
                'type' => $item->type,
                'password' => $item->password,
                'status' => "baru"
            ]);
        }
        // $time = date('Y-m-d');
        
        // $userNewK = User::where('created_at','like','%'.$time.'%')->where('type',0)->count();
        // $userNewA = User::where('created_at','like','%'.$time.'%')->where('type',1)->count();
        // $userNewP = User::where('created_at','like','%'.$time.'%')->where('type',2)->count();
        // Jadwal::create([
        //     'tanggal_jadwal' => $time,
        //     'kandidat_baru' => $userNewK,
        //     'akademi_baru' => $userNewA,
        //     'perusahaan_baru' => $userNewP,
        //     'status' => "baru",
        // ]);

        // $userLoginK = User::where('updated_at','like','%'.$time.'%')->where('type',0)->count();
        // $userLoginA = User::where('updated_at','like','%'.$time.'%')->where('type',1)->count();
        // $userLoginP = User::where('updated_at','like','%'.$time.'%')->where('type',2)->count();
        // Jadwal::create([
        //     'tanggal_jadwal' => $time,
        //     'kandidat_login' => $userLoginK,
        //     'akademi_login' => $userLoginA,
        //     'perusahaan_login' => $userLoginP,
        //     'status' => "login",
        // ]);

        // \log::info("Data telah berjalan");
    }
}
