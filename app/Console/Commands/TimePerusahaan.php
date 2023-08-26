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
        LowonganPekerjaan::where('ttp_lowongan','like','%'.$timeNow.'%')->delete();
    }
}
