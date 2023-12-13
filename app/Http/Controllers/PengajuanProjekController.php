<?php

namespace App\Http\Controllers;

use App\Http\Requests\editProjectRequest;
use App\Http\Requests\PengajuanProjectRequest;
use App\Models\Anggota;
use App\Models\Notifikasi;
use App\Models\Project;
use App\Models\Tema;
use App\Models\Tim;
use App\Models\User;
use App\Notifications\DeadlineNotif;
use Carbon\Carbon;
use GuzzleHttp\Promise\Create;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class PengajuanProjekController extends Controller
{

    protected function ajukanProject(PengajuanProjectRequest $request, $code)
    {
        $tim = Tim::where('code', $code)->firstOrFail();;
        $tim->repository = $request->repository;
        $tim->save();

        $project = Project::where('code', $tim->code)->first();
        if ($project) {
            return abort(404);
        }

        $tema = json_decode($request->temaInput, true);

        foreach ($tema as $data) {
            Tema::create([
                'code' => $code,
                'nama_tema' => $data['value'],
                'tim_id' => $tim->id,
            ]);
        }

        Project::create([
            'code' => $tim->code,
            'tim_id' => $tim->id,
            'tema_id' => null,
            'status_project' => 'notapproved',
            'deadline' => null,
            'type_project' => $tim->status_tim,
        ]);

        $mentorId = User::where('peran_id', 2)->pluck('id')->first();
        if ($mentorId) {
            $this->sendNotificationToMentor($mentorId, 'Pengajuan Project!', 'Ada anggota tim yang mengajukan project.', 'pemberitahuan');
        }

        return back()->with('success', 'Berhasil mengajukan Project, mohon tunggu konfirmasi mentor');
    }

    protected function sendNotificationToMentor($mentorId, $title, $message, $jenisNotifikasi)
    {
        Notifikasi::create([
            'user_id' => $mentorId,
            'judul' => $title,
            'body' => $message,
            'status' => 'belum_dibaca',
            'jenis_notifikasi' => $jenisNotifikasi,
        ]);
    }

    protected function persetujuanProject(Request $request, $code)
    {
        if ($request->deadlineInput) {
            if ($request->deadlineInput < now()) {
                return back()->with('warning', 'Deadline tidak valid');
            } else {
                $deadline = $request->deadlineInput;
            }
        }

        $project = Project::where('code', $code)->firstOrFail();
        $project->tema_id = $request->temaInput;
        $project->status_project = 'approved';

        Tema::where('tim_id', $project->tim_id)
            ->where('id', '!=', $project->tema_id)
            ->delete();

        $deadline = Carbon::now();

        switch ($project->type_project) {
            case 'solo':
                $deadline->addWeek();
                break;
            case 'pre_mini':
                $deadline->addWeek(2);
                break;
            case 'mini':
                $deadline->addWeek(4);
                break;
            case 'pre_big':
                $deadline->addWeek(8);
                break;
            default:
                $deadline->addWeek(8);
                break;
        }

        $project->deadline = $deadline;
        $project->save();

        $teamLeader = $project->tim->anggota;

        $tema = $project->tema;
        foreach ($teamLeader as $member) {
            $this->sendNotification($member->user_id, 'Project Tim Telah Disetujui', 'Project dengan tema "' . $tema->nama_tema . '" telah disetujui.', 'pemberitahuan');
        }

        return back()->with('success', 'Berhasil menyetujui project');
    }

    protected function sendNotification($userId, $title, $message, $jenisNotifikasi)
    {
        $statusAnggota = Anggota::where('user_id', $userId)->value('status');

        if ($statusAnggota !== 'kicked') {
            Notifikasi::create([
                'user_id' => $userId,
                'judul' => $title,
                'body' => $message,
                'status' => 'belum_dibaca',
                'jenis_notifikasi' => $jenisNotifikasi,
            ]);
        }
    }

    protected function editProject(editProjectRequest $request, $code)
    {
        try {
            $userId = Auth::id();
            $user = User::find($userId);

            if ($user->status_kelulusan == '1') {
                return redirect()->back()->with('error', 'Kamu sudah lulus tidak bisa edit tim');
            }

            $timDulu = User::find(Auth::user()->id)->anggota()->whereHas('tim', function ($query) use ($code) {
                $query->where('code', $code);
            })->first();

            if ($timDulu && $timDulu->status == 'kicked') {
                return redirect()->back()->with('error', 'Kamu sudah di kick dari tim');
            }
            $tim = Tim::where('code', $code)->firstOrFail();


            $validated = $request->validated();

            if ($request->hasFile('logo')) {
                $logo = $request->file('logo');
                $logoPath = 'logo/' . time() . '.' . $logo->getClientOriginalExtension();

                // Mengubah ukuran logo menjadi persegi dengan rasio 1:1
                $img = Image::make($logo)->fit(500, 500, function ($constraint) {
                    $constraint->aspectRatio();
                });

                // Simpan logo yang telah diubah ukurannya
                Storage::disk('public')->put($logoPath, $img->stream());

                // Hapus logo lama jika ada
                if ($tim->logo && Storage::disk('public')->exists($tim->logo)) {
                    Storage::disk('public')->delete($tim->logo);
                }

                $tim->update(['logo' => $logoPath]);
            }
            if ($request->deskripsiInput != null) {
                Project::where('tim_id', $tim->id)->update(['deskripsi' => $validated['deskripsiInput']]);
            }
            if ($request->namaTimInput != null) {
                $tim->update(['nama' => $validated['namaTimInput']]);
            }
            if ($request->repoInput != null) {
                $tim->update(['repository' => $validated['repoInput']]);
            }

            return back()->with('success', 'Berhasil mengedit project');
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
    public function destroy($id)
    {
        $notification = Notifikasi::find($id);

        if (!$notification) {
            return response()->json(['error' => 'Notification not found'], 404);
        }

        $notification->delete();

        return response()->json(['message' => 'Notification deleted successfully']);
    }

    public function ambilNotifikasi()
    {
        $userID = Auth::user()->id;
        $notifikasi = Notifikasi::where('user_id', $userID)->get();

        return response()->json(['notifikasi' => $notifikasi]);
    }
}
