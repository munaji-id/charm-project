<?php

namespace App\Http\Controllers;

use App\TipeUser;  # Tipe User Models
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;


class TipeuserController extends Controller
{
    # Digunakan untuk memvalidasi apakah yang mengakses halaman ini sudah login atau belum
    public function __construct()
    {
      $this->middleware('auth');
      $this->middleware('pagerole');
    }

    # Halaman yang pertama terbuka saat membuka menu perusahaan
    public function index() {
      $data['title']  = 'Master Data Tipe Pengguna';
      $tipeuser      = TipeUser::all();
      return view('pages.tipeuser.index', compact('tipeuser'), $data);;
  }

    # Menampilkan form tambah perusahaan
    public function create(Request $request)
      {
          $data['title']  = 'Tambah Data Tipe Pengguna';
          return view('pages.tipeuser.create', $data);
      }
    
    # Menyimpan data perusahaan
    public function store(Request $request)
    {
      $request->validate([
        'nama_tipe_user'     => 'required',
        'deskripsi'          => 'required',
      ]);
      TipeUser::create($request->all());
      return redirect('tipeuser');
    }

    # Menampilkan halaman edit
    public function edit($id)
    {
      $data['title']  = 'Edit Data Tipe Pengguna';
      $tipeID      = Crypt::decrypt($id);
      $tipeuser        = TipeUser::find($tipeID);
      return view('pages.tipeuser.edit', compact('tipeuser'), $data);
    }

    # Menyimpan update data
    public function update(Request $request, $id)
    {
      Tipeuser::find($id)->update($request->all());
      return redirect('tipeuser')->with('success','Tipe User Has Been updated successfully');
    }

    # Menghapus data
    public function destroy(TipeUser $tipeuser)
    {
        $tipeuser->delete();
        return redirect()->route('tipeuser.index')->with('success','Tipe User has been deleted successfully');
    }
}
