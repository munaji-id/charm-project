<?php

namespace App\Http\Controllers;

use Notification;
use App\Cr;  # Cr Models
use App\User;
use App\ProjectModul;
use App\Modul;
use App\Project;
use App\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use App\Notifications\CrNotification;  # Model Notification

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
      // $crs            = Cr::all();
      $user = Auth::user();
      $crs  = Cr::select('change_requests.id',
                     'change_requests.judul',
                     'projects.perusahaan_id',
                     'projects.nama_proyek',
                     'change_requests.modul_id',
                     'change_requests.status_id',
                     'change_requests.batas_waktu',
                     'change_requests.created_at'
                     )
            ->join('projects','projects.id','=','change_requests.proyek_id')
            ->where('projects.perusahaan_id', $user->perusahaan_id)
            ->get();

      return view('pages.cr.index', compact('crs'), $data);
    }

    # Menampilkan form tambah cr
    public function create(request $request)
    {
      error_reporting(0);
      $status         = Status::all();
      $user           = Auth::user();
      $data['title']  = 'Tambah Permintaan Perubahan';
      $projects       = Project::where('perusahaan_id', $user->perusahaan_id)->pluck('nama_proyek', 'id');
      $developers     = User::where('tipe_user_id', 2)->pluck('nama_lengkap', 'id');
      $testers        = User::where('tipe_user_id', 3)->pluck('nama_lengkap', 'id');
      $currents       = User::where('id', $user->id)->pluck('nama_lengkap', 'id');
      $mst            = Cr::where('id', $request->id)->first();
      return view('pages.cr.create', compact('status', 'projects', 'developers', 'testers', 'mst', 'moduls', 'currents'), $data);
    }

    // Fetch records
    public function getModul($proyekid=0){
      $modul['data']  = ProjectModul::orderby('modul_id','asc')
                      ->select('project_moduls.modul_id','moduls.nama_modul')
                      ->join('moduls','project_moduls.modul_id','=','moduls.id')
                      ->where('project_moduls.proyek_id', $proyekid)
                      ->get();

      return response()->json($modul);
 }
    # Menyimpan data
    public function store(Request $request)
    {
      // $request->validate([
      //   'nama_perusahaan' => 'required',
      //   'alamat'          => 'required',
      // ]);
      $id = IdGenerator::generate(['table' => 'change_requests', 'length' => 7, 'prefix' => 'CR']);
      $user = User::where('id', $request->developer)->first();
      $project = Project::where('id', $request->proyek_id)->first();
      $status = status::where('id', 1)->first();
      $cr = Cr::create([
        'id'          => $id,
        'user_id'     => Auth::user()->id,
        'proyek_id'   => $request->proyek_id,
        'modul_id'    => $request->modul_id,
        'status_id'   => '1',
        'judul'       => $request->judul,
        'deskripsi'   => $request->deskripsi,
        'developer'   => $request->developer,
        'tester'      => $request->tester,
        'it_operator' => $request->it_operator,
        'current'     => $request->current,
        'batas_waktu' => $request->batas_waktu
      ]);
      Notification::send($user, new CrNotification($cr, $user, $project, $status));
      return redirect('cr');
    }
}
