<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\LowonganPekerjaan;

class TimePerusahaan extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:time-perusahaan';

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
        $timeNow = date('Y-m-d',strtotime(now()));
        LowonganPekerjaan::create([
            'usia_min' => 20,
            'jabatan' => "checked",
            'pendidikan' => "SMP",
            'jenis_kelamin' => "MF",
            'berat_min' => '40',
            'tinggi' => '156',
            'pencarian_tmp' => "Se-indonesia",
            'id_perusahaan' => "12",
            'isi' => "checked",
            'negara' => "indonesia",
            'gaji_minimum' => "2000000",            
            'gaji_maksimum' => "4000000",            
        ]);
    }
}
