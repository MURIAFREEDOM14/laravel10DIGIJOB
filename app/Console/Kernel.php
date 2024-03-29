<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Log;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected $commands = [
        Commands\TimeJadwal::class,
        Commands\TimePerusahaan::class,
    ];

     protected function schedule(Schedule $schedule): void
    {
        // $schedule->command('app:time-jadwal')->daily();
        $schedule->command('app:time-perusahaan')->daily()->timezone('Asia/Jakarta');
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
