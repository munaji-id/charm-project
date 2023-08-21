<?php

namespace App\Http\Controllers;

// use Notification;
use App\Company;  # Company Models
use App\User;     # User Model
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
// use App\Notifications\EmailNotification;  # Model Notification


class CompanyController extends Controller
{
    # Digunakan untuk memvalidasi apakah yang mengakses halaman ini sudah login atau belum
    public function __construct()
    {
      $this->middleware('auth');
      $this->middleware('pagerole');
    }

    # Halaman yang pertama terbuka saat membuka menu perusahaan
    public function index()
    {
      $data['title']  = 'Master Data Perusahaan';
      $companies      = Company::all();
      return view('pages.company.index', compact('companies'), $data);;
    }

    # Menampilkan form tambah perusahaan
    public function create()
    {
      $data['title']  = 'Tambah Data Perusahaan';
      return view('pages.company.create', $data);
    }
    
    # Menyimpan data perusahaan
    public function store(Request $request)
    {
      $request->validate([
        'id'              => 'required|unique:companies,id,except,id',
        'nama_perusahaan' => 'required',
        'alamat'          => 'required',
      ]);
      // $user = User::first();
      Company::create($request->all());
      // Notification::send($user, new EmailNotification()); # Mengirimkan email saat berhasil di simpan
      return redirect('company')->with('success','Data berhasil disimpan');
    }

    # Menampilkan halaman edit
    public function edit($id)
    {
      $data['title']  = 'Edit Data Perusahaan';
      $companyID      = Crypt::decrypt($id);
      $company        = Company::find($companyID);
      return view('pages.company.edit', compact('company'), $data);
    }

    # Menyimpan update data
    public function update(Request $request, $id)
    {
      $request->validate([
        // 'id'              => 'required|unique:companies,id,except,id',
        'nama_perusahaan' => 'required',
        'alamat'          => 'required',
      ]);
      Company::find($id)->update($request->all());
      return redirect('company')->with('success','Company Has Been updated successfully');
    }

    # Menghapus data
    public function destroy(Company $company)
    {   
      $company->delete();
      return redirect()->route('company.index')->with('success','Company has been deleted successfully');
    }
}
