<?php

namespace App\Console\Commands;

use App\Models\Anggota;
use App\Models\Notifikasi as ModelsNotifikasi;
use App\Models\Presentasi;
use App\Models\Project;
use App\Models\Tim;
use App\Models\Tugas;
use Carbon\Carbon;
use Illuminate\Console\Command;

class Notifikasi extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:notifikasi';

    /**
     * The console command description.
     *
     * @var string
     */
    public function handle()
    {
        $this->checkProjectDeadlines();
        $this->checkTugasDeadlines();
    }

    protected function checkProjectDeadlines()
    {
        $projects = Project::all();

        foreach ($projects as $project) {
            $daysRemaining = $this->calculateDaysRemaining($project->deadline);

            if ($daysRemaining <= 3) {
                $teamMembers = $project->tim->user;

                foreach ($teamMembers as $member) {
                    $this->sendNotification($member->id, 'Deadline Project', 'Deadline project tim Anda tinggal ' . $daysRemaining . ' hari lagi!');
                }
            }
        }
    }
    protected function checkTugasDeadlines()
    {
        $tugasList = Tugas::all();

        foreach ($tugasList as $tugas) {
            if ($tugas->deadline && $tugas->status_tugas !== 'selesai') {
                $deadlineDate = Carbon::parse($tugas->deadline);
                $daysRemaining = $deadlineDate->diffInDays(Carbon::now());

                if ($daysRemaining === 1) {
                    if ($tugas->penugasan) {
                        $userIds = $tugas->penugasan->pluck('user_id')->toArray();

                        foreach ($userIds as $userId) {
                            $this->sendNotification($userId, 'Deadline Tugas', 'Deadline tugas "' . $tugas->nama . '" tinggal 1 hari lagi!');
                        }
                    }
                }
            }
        }
    }



    

    // protected function checkTeamMembership()
    // {
    //     $newMembers = Anggota::where('created_at', '>', Carbon::now()->subDay())->get();

    //     foreach ($newMembers as $newMember) {
    //         $this->sendNotification($newMember->user_id, 'Bergabung Ke Tim!', 'Anda baru saja ditambahkan ke tim '. $newMember->tim->status_tim);
    //     }
    // }

    protected function calculateDaysRemaining($deadline)
    {
        $deadlineDate = Carbon::parse($deadline);
        $currentDate = Carbon::now();

        return $currentDate->diffInDays($deadlineDate);
    }

    protected function sendNotification($userId, $title, $message)
    {
        ModelsNotifikasi::create([
            'user_id' => $userId,
            'judul' => $title,
            'body' => $message,
            'status' => 'belum_dibaca',
        ]);
    }
}
