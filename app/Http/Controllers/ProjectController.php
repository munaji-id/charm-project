<?php

namespace App\Http\Controllers;

use App\Project;
use App\Company;
use App\Modul;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    # Digunakan untuk memvalidasi apakah yang mengakses halaman ini sudah login atau belum
    public function __construct()
    {
      $this->middleware('auth');
      $this->middleware('pagerole');
    }

    # Halaman yang pertama terbuka saat membuka menu perusahaan
    public function index() {
      $data['title']  = 'Master Data Proyek';
      $projects      = Project::all();
      return view('pages.project.index', compact('projects'), $data);
  }

    # Menampilkan form tambah perusahaan
    public function create()
      {
          $data['title']  = 'Tambah Data Proyek';
          $companies = Company::pluck('nama_perusahaan', 'id');
          $moduls    = Modul::pluck('nama_modul', 'id');
          return view('pages.project.create', compact('companies', 'moduls'), $data);
      }
    
    # Menyimpan data perusahaan
    public function store(Request $request)
    {
      $request->validate([
        'nama_proyek'        => 'required',
        'deskripsi'          => 'required',
      ]);
      Project::create($request->all());
      return redirect('project');
    }

    # Menampilkan halaman edit
    public function edit(Project $project)
    {
      $data['title']  = 'Edit Data project';
      return view('pages.project.edit', compact('project'), $data);
    }

    # Menyimpan update data
    public function update(Request $request, $id)
    {
      Project::find($id)->update($request->all());
      return redirect('project')->with('success','Project Has Been updated successfully');
    }

    # Menghapus data
    public function destroy(Project $project)
    {
        $project->delete();
        return redirect()->route('project.index')->with('success','Project has been deleted successfully');
    }
}
