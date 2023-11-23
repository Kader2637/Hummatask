<?php

namespace App\Console\Commands;

use App\Models\Tim;
use Carbon\Carbon;
use Illuminate\Console\Command;

class CheckExpiredTim extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:check-expired-tim';

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
        $tim = Tim::where('kadaluwarsa',0)->get();
        foreach ($tim as $i => $data) {
            if( Carbon::now()->isoFormat('YYYY-MM-DD') === $data->project[0]->deadline ){

                // ngecek tugas cuy
                if($data->tugas->count() === $data->tugas->where('status_tugas','selesai')){
                    // mengubah tim menjadi tidak aktif
                    $data->kadaluwarsa = 1;
                    // mengubah status_project
                    $data->status_project = 1;
                    $data->save();

                }else{
                    $data->kadaluwarsa = 1;
                    $data->status_project = 0;
                    $data->save();
                }
            }
        }
    }
}
