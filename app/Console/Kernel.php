<?php

namespace App\Console;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Console\Commands\Notifikasi;
use App\Console\Commands\NotifikasiSeminggu;
use App\Console\Commands\ResetUrutanPresentasi;
use App\Console\Commands\RestSudahPresentasiTim;

class Kernel extends ConsoleKernel
{

    protected $commands = [
        Commands\RestSudahPresentasiTim::class,
        Commands\ResetUrutanPresentasi::class,
        Commands\Notifikasi::class,
    ];

    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        $schedule->command(ResetUrutanPresentasi::class)->dailyAt('18:00');
        $schedule->command(RestSudahPresentasiTim::class)->weeklyOn('');
        $schedule->command(Notifikasi::class)->daily();
        $schedule->command(NotifikasiSeminggu::class)->weeklyOn(4, '8:00');
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
