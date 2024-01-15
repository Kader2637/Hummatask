<?php

namespace App\Http\Controllers;

use App\Http\Requests\LimitPresentasiDivisiRequest;
use App\Services\WhacenterService;
use App\Http\Requests\RequestPengajuanPresentasi;
use App\Http\Requests\RequestPenolakanPresentasi;
use App\Http\Requests\RequestPersetujuanPresentasi;
use App\Models\Anggota;
use App\Models\HistoryPresentasi;
use App\Models\LimitPresentasiDevisi;
use App\Models\Notifikasi;
use App\Models\Presentasi;
use App\Models\TidakPresentasiMingguan;
use App\Models\Tim;
use App\Models\User;
use Carbon\Carbon;
use Carbon\Exceptions\Exception as ExceptionsException;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class PresentasiController extends Controller
{
    protected function historiPresentasiPage()
    {
        $hariIni = Carbon::now()->toDateString();

        $userID = Auth::user()->id;

        $presentasiSelesai = Presentasi::where('status_presentasi', 'selesai')
            ->whereDate('created_at', $hariIni)
            ->get();

        $tidakPresentasi = Tim::where('sudah_presentasi', 0)
            ->whereDate('created_at', $hariIni)
            ->whereDoesntHave('presentasi', function ($query) use ($hariIni) {
                $query->whereDate('created_at', $hariIni);
            })
            ->get();
        // dd($tidakPresentasi);
        $notifikasi = Notifikasi::where('user_id', $userID)->get();
        return view('mentor.history-presentasi', compact('notifikasi', 'presentasiSelesai', 'tidakPresentasi', 'hariIni'));
    }

    protected function ajukanPresentasi(RequestPengajuanPresentasi $request, $code)
    {
        $tim = Tim::where('code', $code)->firstOrFail();
        $anggota = $tim
            ->anggota()
            ->where('user_id', Auth::user()->id)
            ->first();

        if ($anggota->jabatan_id != 1) {
            return back()->with('error', 'Yang mengajukan tim hanya ketua kelompok');
        }

        if (Carbon::now()->isoFormat('HH:m:ss') < '08:00:00') {
            return back()->with('error', 'Pengajuan Presentasi dimulai pukul 08:00');
        }

        // if (Carbon::now()->isoFormat('dddd') === 'Minggu' || Carbon::now()->isoFormat('dddd') === 'Sabtu') {
        //     return back()->with('error', 'Pengajuan Presentasi hanya bisa dilakuakn dijam kantor');
        // }

        if ($request->plan == null) {
            return back()->with('error', 'Mohon pilih jadwal presentasi');
        }

        try {
            $tim = Tim::where('code', $code)->first();
            if ($tim->kadaluwarsa == 1) {
                return back()->with('error', 'Tim anda sudah kadaluwarsa');
            }

            $validasiPersetujuan = $tim->presentasi->sortByDesc('created_at')->first();

            if ($validasiPersetujuan !== null) {
                if ($validasiPersetujuan->status_presentasi === 'menunggu') {
                    return back()->with('error', 'Tim anda sudah terjadwal presentasi');
                }
            }

            if ($tim->sudah_presentasi == 0) {
                $tidakPresentasiMingguan = TidakPresentasiMingguan::where('tim_id', $tim->id)
                    ->latest()
                    ->first();

                if ($tidakPresentasiMingguan) {
                    $tidakPresentasiMingguan->delete();
                }
            }

            $tim->sudah_presentasi = false;
            $tim->save();

            $validasi = $tim->presentasi->where('jadwal', Carbon::now()->isoFormat('YYYY-M-DD'))->first();

            if ($validasi != null) {
                return back()->with('error', 'Pengajuan presentasi dalam sehari hanya boleh 1 kali');
            }
        } catch (ExceptionsException $th) {
            return redirect()
                ->back()
                ->with('error', 'Timmu tidak ditemukan');
        }

        $jadwalQuery = LimitPresentasiDevisi::find($request->plan);

        if ($jadwalQuery->presentasiDivisi->day == 'monday') {
            $day = 'senin';
        } else if ($jadwalQuery->presentasiDivisi->day == 'tuesday') {
            $day = 'selasa';
        } else if ($jadwalQuery->presentasiDivisi->day == 'wednesday') {
            $day = 'rabu';
        } else if ($jadwalQuery->presentasiDivisi->day == 'thursday') {
            $day = 'kamis';
        } else if ($jadwalQuery->presentasiDivisi->day == 'friday') {
            $day = 'jumat';
        }

        $presentasi = new Presentasi();
        $presentasi->code = Str::uuid();
        $presentasi->judul = $request->judul;
        $presentasi->divisi_id = auth()->user()->divisi_id;
        $presentasi->deskripsi = $request->deskripsi ?: null;
        $presentasi->jadwal = Carbon::now()->isoFormat('Y-M-DD');
        $presentasi->tim_id = $tim->id;
        $presentasi->jadwal_ke = $jadwalQuery->jadwal_ke;
        $presentasi->hari = $day;
        $presentasi->mulai = $jadwalQuery->mulai;
        $presentasi->akhir = $jadwalQuery->akhir;
        $history = HistoryPresentasi::latest()->first();

        if ($history === null) {
            $historyBaru = new HistoryPresentasi();
            $historyBaru->code = Str::uuid();
            $historyBaru->save();

            $presentasi->history_presentasi_id = $historyBaru->id;
        } else {
            $presentasi->history_presentasi_id = $history->id;
        }
        $cek_present = Presentasi::query()
            ->whereDate('jadwal', now())
            ->where('divisi_id', auth()->user()->divisi_id)
            ->get();

        foreach ($cek_present as $present) {
            if ($present->jadwal_ke === $jadwalQuery->jadwal_ke) {
                return redirect()->back()->with('error', 'Jadwal sudah dipilih tim lain');
            }
        }

        $presentasi->status_presentasi_mingguan = false;
        $presentasi->save();

        $mentorId = User::where('peran_id', 2)
            ->pluck('id')
            ->first();
        if ($mentorId) {
            $this->sendNotificationToMentor($mentorId, 'Pengajuan Presentasi!', 'Ada anggota tim yang mengajukan presentasi.', 'pemberitahuan');
        }

        return redirect()
            ->back()
            ->with('success', 'Berhasil mengajukan presentasi');
    }

    protected function updatePresentasi(Request $request, $id){
        $jadwalQuery = LimitPresentasiDevisi::find($request->plan);
        // dd($jadwalQuery);
        $presentasi = Presentasi::query()
            ->where('id', $id)
            ->update([
                'jadwal_ke' => $jadwalQuery->jadwal_ke,
                'mulai' => $jadwalQuery->mulai,
                'akhir' => $jadwalQuery->akhir,
            ]);
        // dd($request, $presentasiID);
        return redirect()->back()->with('success', 'Berhasil Merubah Jadwal');
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

    protected function persetujuanPresentasi(RequestPersetujuanPresentasi $request, $code)
    {
        $dataPresentasi = Presentasi::where('jadwal', Carbon::now()->isoFormat('YYYY-MM-DD'))
            ->get()
            ->count();

        $presentasi = Presentasi::where('code', $code)->first();
        $presentasi->urutan = $dataPresentasi + 1;
        $presentasi->user_approval_id = Auth::user()->id;
        $presentasi->jadwal = Carbon::now()->isoFormat('YYYY-MM-DD');
        $presentasi->status_pengajuan = 'disetujui';
        $presentasi->save();

        $otherRequest = Presentasi::query()
            ->where('limit_presentasi_devisi_id', $presentasi->limitPresentasiDivisi->id)
            ->get()
            ->except($presentasi->id);
        if ($otherRequest->isNotEmpty()) {
            $otherRequest->each(function ($request) {
                $request->update([
                    'feedback' => 'Maaf, tim lain telah menggunakan jadwal sesi yang anda pilih',
                ]);
                $this->rejectPresentation($request);
            });
        }

        $message = 'Pengajuan Presentasi Tim Anda telah disetujui';
        $teamMembers = $presentasi->tim->anggota;

        foreach ($teamMembers as $member) {
            $userId = $member->user_id;
            $statusAnggota = Anggota::where('user_id', $userId)->value('status');
            if ($statusAnggota !== ['kicked', 'expired']) {
                if ($member->jabatan_id === 1) {
                    $phoneNumber = $member->user->tlp;

                    $this->sendWhatsAppPersetujuan($phoneNumber, $message);
                }
            }
        }

        return response()->json([
            'presentasi' => $presentasi,
            'totalPresentasi' => $presentasi->where('status_presentasi', 'selesai')->count(),
            'presentasiDitolak' => $presentasi->where('status_pengajuan', 'ditolak')->count(),
            'revisiSelesai' => $presentasi->where('status_revisi', 'selesai')->count(),
            'revisiTidakSelesai' => $presentasi->where('status_revisi', 'tidak_selesai')->count(),
            'codeHistory' => $presentasi->historyPresentasi->code,
        ]);
    }

    protected function sendWhatsAppNotificationOnRejection($phoneNumber, $message)
    {
        $whacenter = new WhacenterService();
        $whacenter
            ->to($phoneNumber)
            ->line($message)
            ->send();
    }

    protected function rejectPresentation($presentasi)
    {
        $messageToTeam = 'Presentasi Tim Anda ditolak karena jadwal sudah dipilih oleh tim lain.';

        $this->sendWhatsAppNotificationOnRejection($presentasi->tim->anggota->where('jabatan_id', 1)->first()->user->tlp, $messageToTeam);
    }
    protected function sendWhatsAppPersetujuan($phoneNumber, $message)
    {
        $whacenter = new WhacenterService();
        $whacenter
            ->to($phoneNumber)
            ->line($message)
            ->send();
    }
    protected function sendWhatsAppPenolakan($phoneNumber, $message)
    {
        $whacenter = new WhacenterService();
        $whacenter
            ->to($phoneNumber)
            ->line($message)
            ->send();
    }

    protected function sendNotificationToTeamMembers($teamMembers, $title, $message, $jenisNotifikasi)
    {
        foreach ($teamMembers as $member) {
            $statusAnggota = $member->status;

            if ($statusAnggota != ['kicked', 'expired']) {
                Notifikasi::create([
                    'user_id' => $member->user_id,
                    'judul' => $title,
                    'body' => $message,
                    'status' => 'belum_dibaca',
                    'jenis_notifikasi' => $jenisNotifikasi,
                ]);
            }
        }
    }

    protected function penolakanPresentasi(RequestPenolakanPresentasi $request, $code)
    {
        try {
            if ($request->alasan === null) {
                return response()->json(['error' => 'Alasan penolakan tidak boleh kosong']);
            }

            $presentasi = Presentasi::where('code', $code)->first();
            $presentasi->status_pengajuan = 'ditolak';
            $presentasi->feedback = $request->alasan;
            $presentasi->user_approval_id = Auth::user()->id;
            $presentasi->save();

            $message = 'Pengajuan Presentasi Tim Anda ditolak, Karena ' . $request->alasan;
            $teamMembers = $presentasi->tim->anggota;

            foreach ($teamMembers as $member) {
                $userId = $member->user_id;
                $statusAnggota = Anggota::where('user_id', $userId)->value('status');
                if ($statusAnggota !== 'kicked' && $statusAnggota !== 'expired') {
                    if ($member->jabatan_id === 1) {
                        $phoneNumber = $member->user->tlp;

                        $this->sendWhatsAppPenolakan($phoneNumber, $message);
                    }
                }
            }

            return response()->json(['success' => 'Berhasil Memberikan Penolakan']);
        } catch (\Exception $e) {
            Log::error('Error in penolakanPresentasi: ' . $e->getMessage());
            return response()->json(['error' => 'Terjadi kesalahan saat menolak presentasi'], 500);
        }
    }

    protected function konfirmasiPresentasi(Request $request, $code)
    {
        if ($request->status_revisi === null) {
            return back()->with('warning', 'Status revisi tidak boleh kosong');
        }

        if (Str::length($request->feedback) > 300) {
            return back()->with('warning', 'Feedback kepada user tidak boleh lebih dari 300 karakter');
        }

        if ($request->status_presentasi === null) {
            return back()->with('warning', 'Status presentasi harus di isi');
        }

        $presentasi = Presentasi::query()
            ->where('code', $code)
            ->update([
                'status_presentasi' => $request->status_presentasi,
                'status_revisi' => $request->status_revisi,
                'feedback' => $request->feedback,
                'user_approval_id' => auth()->id(),
            ]);

        if ($presentasi) {
            $presentasiQuery = Presentasi::where('code', $code)->first();
            if ($presentasiQuery->status_presentasi === 'selesai' || $presentasiQuery->status_revisi === 'tidak_selesai') {
                $presentasiQuery->tim->update([
                    'sudah_presentasi' => true,
                ]);
                $presentasiQuery->update([
                    'status_presentasi_mingguan' => true,
                ]);
            }
        }

        if ($presentasi) {
            return back()->with('success', 'Berhasil konfirmasi presentasi');
        } else {
            return back()->with('warning', 'Data presentasi tidak ditemukan');
        }
    }

    protected function aturJadwal(Request $request, $code)
    {
        $presentasi = Presentasi::where('code', $code)->first();
        $presentasi->jadwal = $request->jadwalBaru;
        $presentasi->save();

        $jadwal = Carbon::parse($presentasi->jadwal)->isoFormat('DD MMMM YYYY');
        $hari = Carbon::parse($presentasi->jadwal)->isoFormat('dddd');
        return response()->json([$jadwal, $hari]);
    }

    protected function tampilkanDetailPresentasi(Request $request, $code)
    {
        $history = HistoryPresentasi::with([
            'presentasi.tim.user',
            'presentasi.tim.project.tema',
            'presentasi.limitPresentasiDivisi.presentasiDivisi' => function ($query) {
                $query->where('divisi_id', Auth::user()->divisi_id);
            },
        ])
            ->where('code', $code)
            ->first();

        $presentasi = $history->presentasi->where('status_pengajuan', 'menunggu');

        $judulModal = Carbon::now()->isoFormat('DD MMMM YYYY');

        $konfirmasi_presentasi = Presentasi::with([
            'tim.user',
            'tim.project.tema',
            'tim.presentasi',
            'limitPresentasiDivisi.presentasiDivisi' => function ($query) {
                $query->where('divisi_id', Auth::user()->divisi_id);
            },
        ])
            ->where('history_presentasi_id', $history->id)
            ->where('status_presentasi', 'menunggu')
            // ->where('status_pengajuan', 'disetujui')
            ->whereDate('jadwal', Carbon::now()->format('Y-m-d'))
            ->orderBy('urutan', 'asc')
            ->get();

        $konfirmasi_presentasi_date = [];
        $totalPresentasi = [];
        $totalPresentasiDitolak = [];
        $revisiSelesai = [];
        $revisiTidakSelesai = [];
        $deadline = [];
        $dataPresentasiTim = [];

        foreach ($konfirmasi_presentasi as $data) {
            $konfirmasi_presentasi_date[] = Carbon::parse($data->jadwal)->isoFormat('DD MMMM YYYY');
            $totalPresentasi[] = $data->tim->presentasiSelesai->count();
            // $totalPresentasiDitolak[] = $data->tim->presentasi->where('status_pengajuan', 'ditolak')->count();
            $revisiSelesai[] = $data->tim->presentasi->where('status_revisi', 'selesai')->count();
            $revisiTidakSelesai[] = $data->tim->presentasi->where('status_revisi', 'tidak_selesai')->count();
            $deadline[] = Carbon::parse($data->tim->project[0]->deadline)->isoFormat('DD MMMM YYYY');
            $dataPresentasiTim[] = $data->tim->presentasi;
        }

        // dd(Carbon::parse($history->created_at)->weekOfYear);

        $tim_belum_presentasi = TidakPresentasiMingguan::with('tim.project.tema', 'tim.user')
            ->where('history_presentasi_id', $history->id)
            ->get();

        // dd($tim_belum_presentasi);

        $data = [
            'presentasi' => $presentasi,
            'konfirmasi' => [$konfirmasi_presentasi, $konfirmasi_presentasi_date, $totalPresentasi, $totalPresentasiDitolak, $revisiSelesai, $revisiTidakSelesai, $deadline, $dataPresentasiTim],
            'belum_presentasi' => $tim_belum_presentasi,
            'codeHistory' => $history->code,
            'judulModal' => $judulModal,
        ];

        return response()->json($data);
    }

    protected function gantiUrutan(Request $request, $code)
    {
        try {
            $presentasi = Presentasi::where('status_presentasi', 'menunggu')
                ->where('status_pengajuan', 'disetujui')
                ->where('jadwal', Carbon::now()->isoFormat('Y-M-DD'))
                ->orderBy('urutan', 'asc')
                ->get();

            if (!(is_numeric($request->urutanTergantikan) && ctype_digit($request->urutanTergantikan))) {
                return response()->json(['error' => 'Kamu memasukan urutan yang bukan bernilai integer']);
            }

            $validasi = Presentasi::where('status_presentasi', 'selesai')
                ->where('jadwal', Carbon::now()->isoFormat('Y-M-DD'))
                ->where('urutan', $request->urutanTergantikan)
                ->first();
            if (isset($validasi)) {
                return response()->json(['error' => 'kamu memasukan urutan yang sudah dikonfirmasi']);
            }

            if ($request->urutanTergantikan > $presentasi->last()->urutan) {
                return response()->json(['error' => 'kamu memasukan urutan yang lebih besar dari data']);
            }

            $urutanTergantikan = $request->urutanTergantikan;

            // Temukan presentasi yang akan digantikan

            $pengganti = $presentasi->where('code', $code)->first();

            if ($pengganti === null) {
                return response(['error', 'Tidak bisa menemukan data Presentasi']);
            }

            // Jika presentasi pengganti ditemukan
            if ($pengganti) {
                $urutanAwalPengganti = $pengganti->urutan;

                foreach ($presentasi as $model) {
                    if ($urutanAwalPengganti > $urutanTergantikan) {
                        if ($model->urutan >= $urutanTergantikan && $model->urutan < $urutanAwalPengganti) {
                            $model->update(['urutan' => $model->urutan + 1]);
                        }
                    } else {
                        if ($model->urutan > $urutanAwalPengganti && $model->urutan <= $urutanTergantikan) {
                            $model->update(['urutan' => $model->urutan - 1]);
                        }
                    }
                }

                // Ubah urutan presentasi pengganti
                $pengganti->urutan = $urutanTergantikan;
                $pengganti->save();
            }
            $history = HistoryPresentasi::with(['presentasi.tim.user', 'presentasi.tim.project.tema', 'presentasi.tim.presentasiSelesai'])
                ->where('code', $request->codeHistory)
                ->first();
            $urutanPresentasi = $history->presentasi->where('status_presentasi', 'menunggu')->where('jadwal', Carbon::now()->isoFormat('Y-M-DD'));
            $data = [
                'presentasi' => $urutanPresentasi->where('status_pengajuan', 'disetujui'),
                'presentasiDitolak' => $urutanPresentasi->where('status_presentasi', 'ditolak'),
            ];
            return response()->json($data);
        } catch (Exception $th) {
            return response()->json($th);
        }
    }

    protected function ambilUrutan($codeHistory)
    {
        $history = HistoryPresentasi::with(['presentasi.tim.user', 'presentasi.tim.project.tema', 'presentasi.tim.presentasiSelesai'])
            ->where('code', $codeHistory)
            ->first();

        $urutanPresentasi = Presentasi::with(['tim.user', 'tim.project.tema', 'tim.presentasi'])
            ->where('history_presentasi_id', $history->id)
            ->where('status_presentasi', 'menunggu')
            ->whereDate('jadwal', Carbon::now()->format('Y-m-d'))
            ->orderBy('urutan', 'asc')
            ->get();

        $totalPresentasiDitolak = [];
        $totalRevisiSelesai = [];
        $totalRevisiTidakSelesai = [];
        $totalPresentasiSelesai = [];

        foreach ($urutanPresentasi as $data) {
            $totalPresentasiDitolak[] = $data->tim->presentasi->where('status_pengajuan', 'ditolak')->count();
            $totalRevisiSelesai[] = $data->tim->presentasi->where('status_revisi', 'selesai')->count();
            $totalRevisiTidakSelesai[] = $data->tim->presentasi->where('status_revisi', 'tidak_selesai')->count();
            $totalPresentasiSelesai[] = $data->tim->presentasiSelesai->count();
        }

        return response()->json([
            'presentasi' => $urutanPresentasi->where('status_pengajuan', 'disetujui'),
            'presentasiDitolak' => $totalPresentasiDitolak,
            'revisiSelesai' => $totalRevisiSelesai,
            'revisiTidakSelesai' => $totalRevisiTidakSelesai,
            'presentasiSelesai' => $totalPresentasiSelesai,
        ]);
    }

    protected function ambilDetailHistoryPresentasi($codeHistory, $codeTim)
    {
        $history = HistoryPresentasi::where('code', $codeHistory)->first();
        $tim = Tim::with('ketuaTim')
            ->where('code', $codeTim)
            ->first();
        try {
            //code...
            $presentaseRevisi = ($tim->presentasi->where('status_revisi', 'selesai')->count() / $tim->presentasi->where('status_presentasi', 'selesai')->count()) * 100;
        } catch (\Throwable $th) {
            $presentaseRevisi = 0;
            //throw $th;
        }
        $waktu = [];

        foreach ($tim->presentasi as $data) {
            $created_at = Carbon::parse($data->jadwal);
            $waktu[] = $created_at->diffInDays(Carbon::now());
        }

        return response()->json([
            'presentasi' => [$tim->presentasiSelesai, $waktu],
            'tim' => $tim,
            'presentaseRevisi' => $presentaseRevisi,
        ]);
    }
}
