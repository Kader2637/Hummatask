<?php

namespace App\Console\Commands;

use App\Models\HistoryPresentasi;
use Illuminate\Console\Command;
use Illuminate\Support\Str;

class HistoriPresentasiMingguan extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:histori-presentasi-mingguan';

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
        $history = new HistoryPresentasi;
        $history->code = Str::uuid();
        $history->save();
    }
}
