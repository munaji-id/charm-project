<?php

namespace App\Http\Controllers;

use App\User; // Models
use App\Company; // Models
use App\TipeUser; // Models
use Illuminate\Http\Request;

class UserController extends Controller
{   
    public function __construct()
    {
      $this->middleware('auth');
    }

    public function index() {
        $data['title']  = 'Master Data Pengguna';
        $users          = User::all();
        return view('pages.master-data.index', compact('users'), $data);
    }

    public function create(Request $request)
    {
        $data['title']  = 'Tambah Data Pengguna';
        $companies  = Company::pluck('nama_perusahaan', 'id');
        $utypes     = TipeUser::pluck('nama_tipe_user', 'id');
        return view('pages.master-data.create', compact('companies', 'utypes'), $data);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
