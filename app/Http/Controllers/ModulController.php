<?php

namespace App\Http\Controllers;

use App\Modul;  # Modul Models
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ModulController extends Controller
{
    # Digunakan untuk memvalidasi apakah yang mengakses halaman ini sudah login atau belum
    public function __construct()
    {
      $this->middleware('auth');
      $this->middleware('pagerole');
    }

    # Halaman yang pertama terbuka saat membuka menu perusahaan
    public function index() {
      $data['title']  = 'Master Data Modul';
      $moduls      = Modul::all();
      return view('pages.modul.index', compact('moduls'), $data);;
  }

    # Menampilkan form tambah perusahaan
    public function create(Request $request)
      {
          $data['title']  = 'Tambah Data Modul';
          return view('pages.modul.create', $data);
      }
    
    # Menyimpan data perusahaan
    public function store(Request $request)
    {
      $request->validate([
        'nama_modul'         => 'required',
        'deskripsi'          => 'required',
      ]);
      Modul::create($request->all());
      return redirect('modul');
    }

    # Menampilkan halaman edit
    public function edit(Modul $modul)
    {
      $data['title']  = 'Edit Data Modul';
      return view('pages.modul.edit', compact('modul'), $data);
    }

    # Menyimpan update data
    public function update(Request $request, $id)
    {
      Modul::find($id)->update($request->all());
      return redirect('modul')->with('success','Modul Has Been updated successfully');
    }

    # Menghapus data
    public function destroy(Modul $modul)
    {
        $modul->delete();
        return redirect()->route('modul.index')->with('success','Modul has been deleted successfully');
    }
}
