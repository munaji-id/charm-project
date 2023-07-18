<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use App\Http\Controllers\CrController;

class DashboardController extends Controller
{
    # Halaman yang pertama terbuka saat membuka menu perusahaan
    public function index()
    {
      $data['title']  = 'Dashboard';
      // $crs = (new CrController)->index();
      return view('dashboard.index',$data);
    }
}
