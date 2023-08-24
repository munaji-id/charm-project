<?php

namespace App\Http\Controllers;

use Notification;
use App\User; // Models
use App\Company; // Models
use App\TipeUser; // Models
use Hash;
use Illuminate\Http\Request;
use App\Notifications\EmailNotification;  # Model Notification
use Illuminate\Support\Facades\Crypt;

class UserController extends Controller
{   
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('pagerole');
    }

    public function index() {
        $data['title']  = 'Master Data Pengguna';
        $users          = User::all();
        return view('pages.user.index', compact('users'), $data);
    }

    public function create(Request $request)
    {
        error_reporting(0);
        $data['title']  = 'Tambah Data Pengguna';
        $companies      = Company::pluck('nama_perusahaan', 'id');
        $utypes         = TipeUser::pluck('nama_tipe_user', 'id');
        $id             = $request->id;
        // $mst            = Project::where('id',$request->id)->first();
        return view('pages.user.create', compact('companies', 'id', 'utypes'), $data);
    }

    # Menyimpan data proyek
    public function store(Request $request)
    {
    $user = User::first();
    $request->validate([
        'name'              => 'required|unique:users,name,except,id',
        'perusahaan_id'     => 'required',
        'tipe_user_id'      => 'required',
        'email'             => 'required|unique:users,email,except,id',
        'password'          => 'required',
        'retype_password'   => 'required',
        'nama_lengkap'      => 'required',
        'kontak'            => 'required',
      ]);
    //   $count=count($request->modul_id);
    if($request->password <> $request->retype_password) {
        return back()->with('error', 'Password tidak sama');
    } else {
        if($request->id==0) {
            $user = User::create([
                'tipe_user_id'  => $request->tipe_user_id,
                'perusahaan_id' => $request->perusahaan_id,
                'name'          => $request->name,
                'email'         => $request->email,
                'password'      => Hash::make($request->password),
                'nama_lengkap'  => $request->nama_lengkap,
                'kontak'        => $request->kontak,
            ]);
            Notification::send($user, new EmailNotification($request)); # Mengirimkan email saat berhasil di simpan
            // for($x=0;$x<$count;$x++){
            //   ProjectModul::create(['proyek_id' => $project->id,
            //   'modul_id'  => $request->modul_id[$x]]);
            // }
        } else {
            $user = User::where('id',$request->id)->update([
              'tipe_user_id'    =>$request->tipe_user_id,
              'perusahaan_id'   =>$request->perusahaan_id,
              'name'            =>$request->name,
              'email'           =>$request->email,
              'password'        =>$request->password,
              'nama_lengkap'    =>$request->nama_lengkap,
              'kontak'          =>$request->kontak,
            ]);
            // $delete=ProjectModul::where('proyek_id',$request->id)->delete();
            // for($x=0;$x<$count;$x++){
            //   ProjectModul::create(['proyek_id' => $request->id,
            //   'modul_id'  => $request->modul_id[$x]]);
            // }
            // $user = User::create($request->all());
        }
            return redirect('user')->with('success','Data berhasil disimpan');
    }

    }

    public function show(User $user)
    {
      $data['title']  = 'Detail Pengguna';
      $companies      = Company::pluck('nama_perusahaan', 'id');
      $utypes         = TipeUser::pluck('nama_tipe_user', 'id');
      return view('pages.user.show', compact('user', 'companies', 'utypes'), $data);
    }

    public function edit($id)
    {
      $data['title']  = 'Edit Data Pengguna';
      $companies      = Company::pluck('nama_perusahaan', 'id');
      $utypes         = TipeUser::pluck('nama_tipe_user', 'id');
      $userID         = Crypt::decrypt($id);
      $user           = User::find($userID);
      return view('pages.user.edit', compact('user', 'utypes', 'companies'), $data);
    }

    public function update(Request $request, $id)
    {
      User::find($id)->update($request->all());
      return redirect('user')->with('success','Data berhasil dirubah');
    }

    public function change_password(Request $request, $id) {
        
        User::where('id', $id)->update([
            'id' => $request->id,
            'password' => Hash::make($request->password_n)]);
        return back()->with('success', 'Password berhasil dirubah');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('user.index')->with('success','Pengguna has been deleted successfully');
    }
}
