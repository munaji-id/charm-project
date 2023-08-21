<?php

namespace App\Http\Controllers;

use App\TipeAttachment;  # Tipe Attach Models
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class TipeattachmentController extends Controller
{
        # Digunakan untuk memvalidasi apakah yang mengakses halaman ini sudah login atau belum
        public function __construct()
        {
          $this->middleware('auth');
          $this->middleware('pagerole');
        }
    
        # Halaman yang pertama terbuka saat membuka menu perusahaan
        public function index() {
          $data['title']  = 'Master Data Tipe Lampiran';
          $tipeattachs      = TipeAttachment::all();
          return view('pages.tipeattach.index', compact('tipeattachs'), $data);;
      }
    
        # Menampilkan form tambah perusahaan
        public function create(Request $request)
          {
              $data['title']  = 'Tambah Data Tipe Lampiran';
              return view('pages.tipeattach.create', $data);
          }
        
        # Menyimpan data perusahaan
        public function store(Request $request)
        {
          $request->validate([
            'id'                    => 'required|unique:tipe_attachments,id,except,id',
            'nama_tipe_attachment'  => 'required',
          ]);
          TipeAttachment::create($request->all());
          return redirect('tipeattach')->with('success','Data berhasil disimpan');
        }
    
        # Menampilkan halaman edit
        public function edit($id)
        {
          $data['title']  = 'Edit Data Tipe Lampiran';
          $tipeID         = Crypt::decrypt($id);
          $tipeattach     = TipeAttachment::find($tipeID);
          return view('pages.tipeattach.edit', compact('tipeattach'), $data);
        }
    
        # Menyimpan update data
        public function update(Request $request, $id)
        {
          $request->validate([
            'id'                    => 'required|unique:tipe_attachments,id,except,id',
            'nama_tipe_attachment'  => 'required',
          ]);
          TipeAttachment::find($id)->update($request->all());
          return redirect('tipeattach')->with('success','Data berhasil dirubah');
        }
    
        # Menghapus data
        public function destroy(TipeAttachment $tipeattach)
        {
            $tipeattach->delete();
            return redirect()->route('tipeattach.index')->with('success','Data berhasil dihapus');
        }
}
