<?php

namespace App\Console;

use App\Models\Tim;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{

    protected $commands = [
        Commands\RestSudahPresentasiTim::class,
        Commands\HistoriPresentasiMingguan::class,
    ];

    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {

        $schedule->command('HistoriPresentasiMingguan')->weeklyOn(5,'14.00');
        $schedule->command('RestSudahPresentasiTim')->sundays();
        


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
