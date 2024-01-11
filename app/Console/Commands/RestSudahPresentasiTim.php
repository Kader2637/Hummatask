<?php

namespace App\Console\Commands;

use App\Models\HistoryPresentasi;
use App\Models\TidakPresentasiMingguan;
use App\Models\Tim;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class RestSudahPresentasiTim extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:rest-sudah-presentasi-tim';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command ini akan mereset status tim setiap minggu';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        DB::table('tims')->update(['sudah_presentasi' => false]);

        $newHistoryPresentasi = new HistoryPresentasi;
        $newHistoryPresentasi->code = Str::uuid();

        $seninDepan = Carbon::now()->addDays(3)->isoFormat("MMMM");

        if (Carbon::now()->isoFormat('MMMM') !== $seninDepan) {
            $newHistoryPresentasi->noMinggu = 1;
            $newHistoryPresentasi->bulan = Carbon::now()->addDays(3)->isoFormat('MMMM');
            $newHistoryPresentasi->tahun = Carbon::now()->addDays(3)->isoFormat('YYYY');
        } else {
            $oldHistory = HistoryPresentasi::all()->sortByDesc('created_at')->first();
            $newHistoryPresentasi->noMinggu = $oldHistory->noMinggu + 1;
            $newHistoryPresentasi->bulan = $oldHistory->bulan;
            $newHistoryPresentasi->tahun = $oldHistory->tahun;
        }

        $newHistoryPresentasi->save();
        $this->handleResetTidakPresentasi($newHistoryPresentasi->id);
    }

    protected function handleResetTidakPresentasi($id)
    {
        $tim = tim::all();
        foreach ($tim as $key => $data) {
            $this->createTidakPresentasi($data->id, $id);
        }
    }

    protected function createTidakPresentasi($timId, $id)
    {
        TidakPresentasiMingguan::create([
            "tim_id" => $timId,
            "history_presentasi_id" => $id,

        ]);
    }
}
