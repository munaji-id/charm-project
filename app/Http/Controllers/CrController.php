<?php

namespace App\Http\Controllers;

use App\Cr;  # Cr Models
use App\User;
use App\ProjectModul;
use App\Modul;
use App\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class CrController extends Controller
{
    # Digunakan untuk memvalidasi apakah yang mengakses halaman ini sudah login atau belum
    public function __construct()
    {
      $this->middleware('auth');
      $this->middleware('pagerole');
    }

    # Halaman yang pertama terbuka
    public function index() {
      $data['title']  = 'Change Request';
      $crs            = Cr::all();
      return view('pages.cr.index', compact('crs'), $data);
    }

    # Menampilkan form tambah cr
    public function create(request $request)
    {
      error_reporting(0);
      $user = Auth::user();
      $data['title']  = 'Tambah Permintaan Perubahan';
      $projects       = Project::where('perusahaan_id', $user->perusahaan_id)->pluck('nama_proyek', 'id');
      $developers     = User::where('tipe_user_id', 2)->pluck('nama_lengkap', 'id');
      $moduls         = ProjectModul::join('moduls','project_moduls.modul_id','=','moduls.id')
                        ->where('project_moduls.proyek_id', 14)
                        ->pluck('moduls.nama_modul','id');
      // $moduls         = Modul::pluck('nama_modul', 'id');
      $mst            = Cr::where('id', $request->id)->first();
      return view('pages.cr.create', compact('projects', 'developers', 'mst', 'moduls'), $data);
    }

    // Fetch records
    public function getModul($proyekid=0){
      // $data['title']  = 'Tambah Permintaan Perubahan';
      // Fetch Employees by Departmentid
      // $modul['data'] = ProjectModul::orderby('modul_id','asc')
      //      ->select('proyek_id','modul_id')
      //      ->where('proyek_id', $modulid)
      //      ->get();
      $modul['data']    = ProjectModul::orderby('modul_id','asc')
                        ->select('project_moduls.modul_id','moduls.nama_modul')
                        ->join('moduls','project_moduls.modul_id','=','moduls.id')
                        ->where('project_moduls.proyek_id', $proyekid)
                        ->get();

      return response()->json($modul);
 }
    # Menyimpan data
    public function store(Request $request)
    {
      $request->validate([
        'nama_perusahaan' => 'required',
        'alamat'          => 'required',
      ]);
      $id = IdGenerator::generate(['table' => 'change_requests', 'length' => 6, 'prefix' => date('y')]);
      // $user = User::first();
      Cr::create([
        'id'          => $id,
        'user_id'     => $request->user_id,
        'proyek_id'   => $request->proyek_id,
        'proyek_id'   => $request->proyek_id,
        'modul_id'    => $request->modul_id,
        'status_id'   => $request->status_id,
        'deskripsi'   => $request->deskripsi,
        'developer'   => $request->developer,
        'tester'      => $request->tester,
        'it_operator' => $request->it_operator,
        'current'     => $request->current,
        'batas_waktu' => $request->batas_waktu
      ]);
      // Notification::send($user, new EmailNotification()); # Mengirimkan email saat berhasil di simpan
      return redirect('cr');
    }
}
