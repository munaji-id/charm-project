<?php

namespace App\Http\Controllers;

// use App\Project;
// use App\Company;
// use App\Modul;
use App\ProjectModul;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class ProjectmodController extends Controller
{
    public function destroy(Request $request, $modul_id)
    {
        // $projectm        = ProjectModul::where('proyek_id', $projectmod->proyek_id)->get();
        // echo $request->proyek_id;
        // echo $modul_id;
        // ProjectModul::where('modul_id', $projectmod->modul_id)->delete();
        // $projectmod->delete();
        $deleted = DB::table('project_moduls')->where('proyek_id', $request->proyek_id)
                    ->where('modul_id', $modul_id)->delete();

        return redirect()->route('project.index')->with('success','Project has been deleted successfully');
    }
}
