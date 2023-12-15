<?php

namespace App\Console\Commands;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\Command;

class CheckLulusUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:check-lulus-user';

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
        $user = User::where('status_kelulusan', 0)->get();
        foreach ($user as $data) {
            if ($data->tanggal_lulus === Carbon::now()->isoFormat('YYYY-MM-DD')) {
                $data->status_kelulusan = 1;
                $data->save();
            }
        }
    }
}
