<?php

namespace App\Http\Controllers;
use App\Cr;  # Cr Models
use App\Modul;  # Cr Models

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    # Halaman yang pertama terbuka saat membuka menu perusahaan
    public function index()
    {
      $data['title']  = 'Dashboard';
      // $crs = (new CrController)->index();
      $user = Auth::user();
      if ($user->perusahaan_id == 1) {
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
            ->where('change_requests.current', $user->id)
            ->get();
      } else {
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
            ->orWhere('change_requests.tester', $user->id)
            ->orWhere('change_requests.developer', $user->id)
            ->orWhere('change_requests.it_operator', $user->id)
            ->get();
      }
      return view('dashboard.index', compact('crs'), $data);
    }
}
