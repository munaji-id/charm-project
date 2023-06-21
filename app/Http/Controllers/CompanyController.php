<?php

namespace App\Http\Controllers;

use Notification;
use App\Company;  # Company Models
use App\User;     # User Model
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Notifications\EmailNotification;  # Model Notification


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
      $user = User::first();
      Company::create($request->all());
      // return redirect()->intended('companies', $data);
      // return redirect('companies');
      // $company->notify(new EmailNotification());
      Notification::send($user, new EmailNotification());

      return redirect('company');
      // dd('Notification sent!');
    }

    public function edit(Company $company)
    {
      $data['title']  = 'Edit Data Perusahaan';
      return view('pages.company.edit', compact('company'), $data);
    }

    public function update(Request $request, $id)
    {
      Company::find($id)->update($request->all());
      return redirect('company')->with('success','Company Has Been updated successfully');
    }

    public function destroy(Company $company)
    {
        $company->delete();
        return redirect()->route('company.index')->with('success','Company has been deleted successfully');
    }

}
