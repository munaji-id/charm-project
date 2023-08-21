<?php

namespace App\Http\Controllers;

use App\Status;  # Status Models
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;


class StatusController extends Controller
{
    # Digunakan untuk memvalidasi apakah yang mengakses halaman ini sudah login atau belum
    public function __construct()
    {
      $this->middleware('auth');
      $this->middleware('pagerole');
    }

    # Halaman yang pertama terbuka saat membuka menu perusahaan
    public function index() {
      $data['title']  = 'Master Data Status';
      $status      = Status::all();
      return view('pages.status.index', compact('status'), $data);;
  }

    # Menampilkan form tambah perusahaan
    public function create(Request $request)
      {
          $data['title']  = 'Tambah Data status';
          return view('pages.status.create', $data);
      }
    
    # Menyimpan data perusahaan
    public function store(Request $request)
    {
      $request->validate([
        'id'                 => 'required|unique:status,id,except,id',
        'nama_status'        => 'required',
        'deskripsi'          => 'required',
      ]);
      status::create($request->all());
      return redirect('status')->with('success','Data berhasil disimpan');
    }

    # Menampilkan halaman edit
    public function edit($id)
    {
      $data['title']  = 'Edit Data status';
      $statusID      = Crypt::decrypt($id);
      $status        = Status::find($statusID);
      return view('pages.status.edit', compact('status'), $data);
    }

    # Menyimpan update data
    public function update(Request $request, $id)
    {
      $request->validate([
        // 'id'                 => 'required|unique:status,id,except,id',
        'nama_status'        => 'required',
        'deskripsi'          => 'required',
      ]);
      status::find($id)->update($request->all());
      return redirect('status')->with('success','Data berhasil diupdate');
    }

    # Menghapus data
    public function destroy(Status $status)
    {
      // $status->validate([
      //   'id'                 => 'required|unique:status,id,except,id',
      // ]);
        $status->delete();
        return redirect()->route('status.index')->with('success','Data berhasil dihapus');
    }
}
