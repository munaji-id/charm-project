<?php

namespace App\Http\Controllers;

use App\Company; // Models
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function __construct()
    {
      $this->middleware('auth');
    }

    public function index() {
      $data['title']  = 'Master Data Perusahaan';
      $companies      = Company::all();
      return view('pages.company.index', compact('companies'), $data);;
  }

    public function create(Request $request)
      {
          $data['title']  = 'Tambah Data Perusahaan';
          return view('pages.company.create', $data);
      }
  
    public function store(Request $request)
    {
      $request->validate([
        'nama_perusahaan' => 'required',
      ]);

      Company::create($request->all());
      return redirect()->intended('companies', $data);
      // return redirect('companies');
    }
}
