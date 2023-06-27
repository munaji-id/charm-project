<?php

namespace App\Http\Controllers;

use App\Project;
use App\Company;
use App\Modul;
use App\ProjectModul;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    # Digunakan untuk memvalidasi apakah yang mengakses halaman ini sudah login atau belum
    public function __construct()
    {
      $this->middleware('auth');
      $this->middleware('pagerole');
    }

    # Halaman yang pertama terbuka saat membuka menu proyek
    public function index() {
      $data['title']  = 'Master Data Proyek';
      $projects      = Project::all();
      return view('pages.project.index', compact('projects'), $data);
  }

    # Menampilkan form tambah proyek
    public function create(request $request)
      {
          error_reporting(0);
          $data['title']  = 'Tambah Data Proyek';
          $companies = Company::pluck('nama_perusahaan', 'id');
          // $selectedCompany = Company::first()->company_id;
          $id=$request->id;
          $mst    = Project::where('id',$request->id)->first();
          $moduls      = Modul::all();
          return view('pages.project.create', compact('companies', 'moduls','mst','id'), $data);
      }
    
    # Menyimpan data proyek
    public function store(Request $request)
    {
      $request->validate([
        'nama_proyek'        => 'required',
        'perusahaan_id'      => 'required',
        'mulai'              => 'required',
        'selesai'            => 'required',
      ]);
      $count=count($request->modul_id);
      if($request->id==0){
        $project = Project::create($request->all());

        for($x=0;$x<$count;$x++){
          ProjectModul::create(['proyek_id' => $project->id,
          'modul_id'  => $request->modul_id[$x]]);
        }
      }else{
        $project = Project::where('id',$request->id)->update([
          'nama_proyek'=>$request->nama_proyek,
          'perusahaan_id'=>$request->perusahaan_id,
          'mulai'=>$request->mulai,
          'selesai'=>$request->selesai,
        ]);
        $delete=ProjectModul::where('proyek_id',$request->id)->delete();
        for($x=0;$x<$count;$x++){
          ProjectModul::create(['proyek_id' => $request->id,
          'modul_id'  => $request->modul_id[$x]]);
        }
      }
    
      return redirect('project');
    }

    # Menampilkan halaman edit
    // public function edit(Project $project)
    // {
    //   $data['title']  = 'Edit Data project';
    //   return view('pages.project.edit', compact('project'), $data);
    // }

    # Menyimpan update data
    public function update(Request $request, $id)
    {
      Project::find($id)->update($request->all());
      return redirect('project')->with('success','Project Has Been updated successfully');
    }

    # Menampilkan detail data
    public function show(Project $project)
    {
      $data['title']       = 'Detail Proyek ID';
      $modul               = Modul::pluck('nama_modul', 'id');
      $project_moduls      = ProjectModul::where('proyek_id', $project->id)->get();
      return view('pages.project.show', compact('project', 'project_moduls'), $data);
    }

    # Menghapus data
    public function destroy(Project $project)
    {
        $project->delete();
        return redirect()->route('project.index')->with('success','Project has been deleted successfully');
    }
}
