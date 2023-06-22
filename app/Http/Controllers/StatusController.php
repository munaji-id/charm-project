<?php

namespace App\Http\Controllers;

use App\Status;  # Status Models
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class StatusController extends Controller
{
    # Digunakan untuk memvalidasi apakah yang mengakses halaman ini sudah login atau belum
    public function __construct()
    {
      $this->middleware('auth');
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
        'nama_status'         => 'required',
        'deskripsi'          => 'required',
      ]);
      status::create($request->all());
      return redirect('status');
    }

    # Menampilkan halaman edit
    public function edit(Status $status)
    {
      $data['title']  = 'Edit Data status';
      return view('pages.status.edit', compact('status'), $data);
    }

    # Menyimpan update data
    public function update(Request $request, $id)
    {
      status::find($id)->update($request->all());
      return redirect('status')->with('success','Status Has Been updated successfully');
    }

    # Menghapus data
    public function destroy(Status $status)
    {
        $status->delete();
        return redirect()->route('status.index')->with('success','Status has been deleted successfully');
    }
}
