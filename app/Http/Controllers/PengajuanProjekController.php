<?php

namespace App\Http\Controllers;

use App\Http\Requests\editProjectRequest;
use App\Http\Requests\PengajuanProjectRequest;
use App\Models\Project;
use App\Models\Tema;
use App\Models\Tim;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
            'type_project' => 'solo',
        ]);

        return back()->with('success', 'Berhasil mengajukan Project, mohon tunggu konfirmasi mentor');
    }

    protected function persetujuanProject(Request $request, $code)
    {

        $project = Project::where('code', $code)->firstOrFail();
        $project->tema_id = $request->temaInput;
        $project->status_project = 'approved';

        $deadline = Carbon::now();

        switch ($project->type_project) {
            case 'solo':
                $deadline->addWeek();
                break;
            case 'premini':
                $deadline->addWeek(2);
                break;
            case 'mini':
                $deadline->addWeek(4);
                break;
            default:
                $deadline->addWeek(8);
                break;
        }

        if ($request->deadlineInput) {
            $deadline = $request->deadlineInput;
        }

        $project->deadline = $deadline;
        $project->save();

        return back()->with('success', 'Berhasil menyetujui project');
    }

    protected function editProject(editProjectRequest $request, $code)
    {
        try {
            $tim = Tim::where('code', $code)->firstOrFail();
            $validated = $request->validated();

            if ($request->hasFile('logo')) {
                Storage::disk('public')->delete($tim->logo);
                $tim->update(['logo' => $validated['logo']->store('logo', 'public')]);
            }
            if ($request->deskripsiInput != null) {
                Project::where('tim_id', $tim->id)->update(['deskripsi' => $validated['deskripsiInput']]);
            }
            if ($request->namaTimInput != null) {
                $tim->update(['nama' => $validated['namaTimInput']]);
            }

            return back()->with('success', 'Berhasil mengedit project');
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
