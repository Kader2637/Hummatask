<?php

namespace App\Console\Commands;

use App\Models\Notifikasi;
use App\Models\Tim;
use Illuminate\Console\Command;

class NotifikasiSeminggu extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:notifikasi-seminggu';

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
        $this->checkProjectPresentasi();
    }

    protected function checkProjectPresentasi()
    {
        $timBelumPresentasi = Tim::where('sudah_presentasi', '!=', 1)->get();

        foreach ($timBelumPresentasi as $tim) {
            $teamMembers = $tim->user;

            foreach ($teamMembers as $member) {
                $this->sendNotification($member->id, 'Presentasi Belum Dilakukan', 'Tim Anda belum melakukan presentasi!');
            }
        }
    }

protected function sendNotification($userId, $title, $message)
    {
        Notifikasi::create([
            'user_id' => $userId,
            'judul' => $title,
            'body' => $message,
            'status' => 'belum_dibaca',
        ]);
    }
}
