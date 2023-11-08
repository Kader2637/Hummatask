<?php

namespace App\Console\Commands;

use App\Models\Presentasi;
use Carbon\Carbon;
use Illuminate\Console\Command;

class ResetUrutanPresentasi extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:reset-urutan-presentasi';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Membuat tim yang belum presentasi pada hari itu dipindah ke hari selanjutnya dengan urutan pertama';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $presentasi = Presentasi::where('jadwal',Carbon::now()->isoFormat('Y-M-DD'))->where('status_presentasi','menunggu')->where('status_pengajuan','disetujui')->orderBy('urutan','asc')->get();

        foreach ($presentasi as $i => $data) {

            if( Carbon::now()->isoFormat('dddd') === "Jumat" ){
                $data->jadwal = Carbon::now()->addDays(3);
            }else{
                $data->jadwal = Carbon::tomorrow();
            }
            $data->urutan = $i+1;
            $data->save();
        }

    }
}
