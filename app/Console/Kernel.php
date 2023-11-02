<?php

namespace App\Console;

use App\Models\HistoryPresentasi;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Str;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        // $schedule->command('inspire')->hourly();


//      Tugas setiap minggu untuk membuat history presentasi
        $schedule->call(function(){
            $history = new HistoryPresentasi;
            $history->code = Str::uuid();
            $history->save();
        })->weekly();
        

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
