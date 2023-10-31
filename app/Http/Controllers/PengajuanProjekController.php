<?php

namespace App\Http\Controllers;

use App\Http\Requests\PengajuanProjectRequest;
use App\Models\Project;
use App\Models\Tema;
use App\Models\Tim;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PengajuanProjekController extends Controller
{

    protected function ajukanProject(Request $request, $code)
    {
        $tim = Tim::where('code', $code)->first();
        $tim->repository = $request->repository;
        $tim->save();

        $tema = json_decode($request->temaInput, true);

        foreach ($tema as $data) {
            $tema = new Tema;
            $tema->code = $code;
            $tema->nama_tema = $data['value'];
            $tema->tim_id = $tim->id;
            $tema->save();
        }

        $project = new Project;
        $project->code = $tim->code;
        $project->tim_id = $tim->id;
        $project->tema_id = null;
        $project->status_project = 'notapproved';
        $project->deadline = null;
        $project->type_project = 'solo';
        $project->save();

        return back()->with('success', 'Berhasil mengajukan Project, mohon tunggu konfirmasi mentor');
    }

    protected function persetujuanProject(Request $request, $code)
    {

        $project = Project::where('code', $code)->firstOrFail();
        $project->tema_id = $request->temaInput;
        $project->status_project = 'approved';

        if (!$request->deadlineInput) {
            $deadline = Carbon::now();
            if ($project->type_project == 'solo') {
                $deadline->addWeek();
            } else if ($project->type_project == 'premini') {
                $deadline->addWeek(2);
            } else if ($project->type_project == 'mini') {
                $deadline->addWeek(4);
            } else {
                $deadline->addWeek(8);
            }
            $project->deadline = $deadline;
        } else {
            $project->deadline = $request->deadlineInput;
        }

        $project->save();
        // dd($project);
        return back()->with('success', 'Berhasil menyetujui project');
    }
}
