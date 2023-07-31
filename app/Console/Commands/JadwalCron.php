<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\Models\Jadwal;


class JadwalCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'jadwalcron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $time = date('Y-m-d');
        $userNewK = User::where('created_at')->count();
        $userNewA = User::where('created_at')->count();
        $userNewP = User::where('created_at')->count();
        Jadwal::create([
            'tanggal_jadwal' => $time,
            'kandidat_baru' => $userNewK,
            'akademi_baru' => $userNewA,
            'perusahaan_baru' => $userNewP,
            'status' => "baru",
        ]);

        $userLoginK = User::where('updated_at')->count();
        $userLoginA = User::where('updated_at')->count();
        $userLoginP = User::where('updated_at')->count();
        Jadwal::create([
            'tanggal_jadwal' => $time,
            'kandidat_login' => $userLoginK,
            'akademi_login' => $userLoginA,
            'perusahaan_login' => $userLoginP,
            'status' => "login",
        ]);
    }
}
