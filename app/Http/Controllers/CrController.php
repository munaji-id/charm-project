<?php

namespace App\Http\Controllers;

use Notification;
use App\Cr;  # Cr Models
use App\User;
use App\ProjectModul;
use App\Modul;
use App\Project;
use App\Status;
use App\Log;
use App\TipeAttachment;
use App\Attachment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use App\Notifications\CrNotification;  # Model Notification
use App\Notifications\CrNotification1;  # Model Notification
use File;
use DB;


class CrController extends Controller
{
    # Digunakan untuk memvalidasi apakah yang mengakses halaman ini sudah login atau belum
    public function __construct()
    {
      error_reporting(0);
      $this->middleware('auth');
      // $this->middleware('pagerole');
      $this->middleware('pageuser');
    }

    # Halaman yang pertama terbuka
    public function index() {
      $data['title']  = 'Permintaan Perubahan';
      // $crs            = Cr::all();
      $user = Auth::user();
      if ($user->perusahaan_id == 'KIT') {
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
      // return 'crs';
      return view('pages.cr.index', compact('crs'), $data);
    }

    # Menampilkan form tambah cr
    public function create(request $request)
    {
      error_reporting(0);
      $status         = Status::where('id', 'like', 'S%' )->get(); #all();
      $user           = Auth::user();
      $data['title']  = 'Tambah Permintaan Perubahan';
      $projects       = Project::where('perusahaan_id', $user->perusahaan_id)->pluck('nama_proyek', 'id');
      $developers     = User::where('tipe_user_id', 'ABA')->pluck('nama_lengkap', 'id');
      $testers        = User::where('tipe_user_id', 'FUN')->pluck('nama_lengkap', 'id');
      // $currents       = User::where('id', $user->id)->pluck('nama_lengkap', 'id');
      $mst            = Cr::where('id', $request->id)->first();
      return view('pages.cr.create', compact('status',
                                             'projects',
                                             'developers',
                                             'testers',
                                             'mst',
                                             'currents'),
                                             $data);
    }

    // Fetch records
    public function getModul($proyekid=0){
      $modul['data']  = ProjectModul::orderby('modul_id','asc')
                      ->select('project_moduls.modul_id','moduls.nama_modul')
                      ->join('moduls','project_moduls.modul_id','=','moduls.id')
                      ->where('project_moduls.proyek_id', $proyekid)
                      ->get();

      return response()->json($modul);
    }
    # Menyimpan data
    public function store(Request $request)
    {
      $request->validate([
        'judul'              => 'required',
        'deskripsi'          => 'required',
        'proyek_id'          => 'required',
        'modul_id'           => 'required',
        'tester'             => 'required',
      ]);
      $id = IdGenerator::generate(['table' => 'change_requests', 'length' => 7, 'prefix' => 'CR']);
      $user = User::where('id', $request->tester)->first();
      $project = Project::where('id', $request->proyek_id)->first();
      $status = status::where('id', 'S1')->first();
      $cr = Cr::create([
        'id'          => $id,
        'user_id'     => Auth::user()->id,
        'proyek_id'   => $request->proyek_id,
        'modul_id'    => $request->modul_id,
        'status_id'   => 'S1',
        'judul'       => $request->judul,
        'deskripsi'   => $request->deskripsi,
        'developer'   => $request->developer,
        'tester'      => $request->tester,
        'it_operator' => $request->it_operator,
        'current'     => 2,
        'batas_waktu' => $request->batas_waktu
      ]);
      $log = Log::create([
        'cr_id' => $id,
        'log'   => Auth::user()->nama_lengkap.' - Permintaan perubahan dibuat dengan nomor '.$id    
      ]);
      Notification::send($user, new CrNotification($cr, $user, $project, $status));
      return redirect('cr')->with('success','Data berhasil disimpan');
    }

    public function edit($id)
    {
      $data['title']  = 'Edit Permintaan Perubahan';
      $user           = Auth::user();
      $cr             = Cr::find($id);
      if ($cr->status_id == 'S1') {
        $data['set_sts']  = 'Set Ready to Development';
      } elseif ($cr->status_id == 'S2') {
        $data['set_sts']  = 'Set Into Development';
      } elseif ($cr->status_id == 'S3') {
        $data['set_sts']  = 'Ready to Test In DEV';
      } elseif ($cr->status_id == 'S4') {
        $data['set_sts']  = 'Set Successfully Testing';
      } elseif ($cr->status_id == 'S5') {
        $data['set_sts']  = 'Ready to Test In QAS';
      } elseif ($cr->status_id == 'S6') {
        $data['set_sts']  = 'Set Successfully Testing';
      } elseif ($cr->status_id == 'S7') {
        $data['set_sts']  = 'Set Ready to PROD';
      } 
      $company        = User::find($cr->user_id );
      $status         = Status::all();
      $user           = Auth::user();
      $projects       = Project::where('perusahaan_id', $company->perusahaan_id)->pluck('nama_proyek', 'id');
      $testers        = User::where('tipe_user_id', 'FUN')->pluck('nama_lengkap', 'id');
      $developers     = User::where('tipe_user_id', 'ABA')->pluck('nama_lengkap', 'id');
      $it_operators   = User::where('tipe_user_id', 'BAS')->pluck('nama_lengkap', 'id');
      $currents       = User::where('id', $cr->current)->pluck('nama_lengkap', 'id');
      $moduls         = ProjectModul::orderby('modul_id','asc')
                      ->select('project_moduls.modul_id','moduls.nama_modul')
                      ->join('moduls','project_moduls.modul_id','=','moduls.id')
                      ->where('project_moduls.proyek_id', $cr->proyek_id)
                      ->get();
      $logs           = Log::where('cr_id', $id)->get();
      $tipe_atts      = TipeAttachment::all();
      $attachments    = Attachment::where('cr_id', $id)->get();
      return view('pages.cr.edit', compact('projects',
                                           'cr',
                                           'status',
                                           'developers',
                                           'testers',
                                           'it_operators',
                                           'moduls',
                                           'currents',
                                           'logs',
                                           'tipe_atts',
                                           'attachments'),
                                           $data);
    }

    public function update(Request $request, $id) {
      $request->validate([
        'judul'              => 'required',
        'deskripsi'          => 'required',
        'proyek_id'          => 'required',
        'modul_id'           => 'required',
        'tester'             => 'required',
        // 'developer'          => 'required',
        // 'it_operator'        => 'required',
        // 'batas_waktu'        => 'required',
      ]);

      Cr::find($id)->update($request->all());
      return back()->with('success','Permintaan perubahan berhasil dirubah');
    }

    public function status_3(Request $request, $id) {
      $user_auth      = Auth::user();
      $cr             = Cr::where('id', $id)->first();
      $attachment     = Attachment::where('cr_id', $id)->first();
      $project        = Project::where('id', $request->proyek_id)->first();
      $status         = Status::where('id', $request->status_id)->first();
      $count = DB::table('attachments')->
      where('cr_id', $cr)->
      selectRaw('count(cr_id) as cnt')->pluck('cnt');

      if ($cr->status_id == 'S1') {
        $user           = User::where('id', $request->developer)->first();
        if ($user_auth->tipe_user_id == 'FUN' AND $user_auth->id == $cr->tester) { //Tester
          if ($request->developer == '') {
            return back()->with('error','Anda belum memilih Developer');
          }
          if (DB::table('attachments')->where('cr_id', $cr->id)->where('attachment_id', 'FS')->doesntExist()) {
            return back()->with('error','Silahkan upload dokumen FS terlebih dahulu');
          }
          Cr::where('id', $id)->update(['status_id' => $request->status_id, 'current' => $cr->developer]);
          $log = Log::create([
            'cr_id' => $id,
            'log'   => Auth::user()->nama_lengkap. ' - Status sudah di tetapkan menjadi "Ready to Development"'    
          ]);
          Notification::send($user, new CrNotification($cr, $user, $project, $status));
        } else {
          return back()->with('error','Anda tidak diperbolehkan merubah ke tahap selanjutnya');
        }
      } elseif ($cr->status_id == 'S2') {
        $user           = User::where('id', $request->developer)->first();
        if ($user_auth->tipe_user_id == 'ABA' AND $user_auth->id == $cr->developer) { //Developer
          Cr::where('id', $id)->update(['status_id' => $status->id, 'current' => $cr->developer]);
          $log = Log::create([
            'cr_id' => $id,
            'log'   => Auth::user()->nama_lengkap. ' - Status sudah di tetapkan menjadi "In Development"'    
          ]);
        } else {
          return back()->with('error','Anda tidak diperbolehkan merubah ke tahap selanjutnya');
        }
      } elseif ($cr->status_id == 'S3') {
        $user           = User::where('id', $request->tester)->first();
        if ($user_auth->tipe_user_id == 'ABA' AND $user_auth->id == $cr->developer) { //Developer
          Cr::where('id', $id)->update(['status_id' => $request->status_id, 'current' => $cr->tester]);
          $log = Log::create([
            'cr_id' => $id,
            'log'   => Auth::user()->nama_lengkap. ' - Status sudah di tetapkan menjadi "Ready to Testing In DEV"' 
          ]);
          Notification::route('mail', $user->email)->notify(new CrNotification($cr, $user, $project, $status));
        } else {
          return back()->with('error','Anda tidak diperbolehkan merubah ke tahap selanjutnya');
        }
      } elseif ($cr->status_id == 'S4') {
        $user           = User::where('id', $request->it_operator)->first();
        if ($user_auth->tipe_user_id == 'FUN' AND $user_auth->id == $cr->tester) { //tester
          Cr::where('id', $id)->update(['status_id' => $request->status_id, 'current' => $cr->it_operator]);
          $log = Log::create([
            'cr_id' => $id,
            'log'   => Auth::user()->nama_lengkap. ' - Status sudah di tetapkan menjadi "Sucessfully Tested In DEV"'    
          ]);
          Notification::route('mail', $user->email)->notify(new CrNotification($cr, $user, $project, $status));
        } else {
          return back()->with('error','Anda tidak diperbolehkan merubah ke tahap selanjutnya');
        }
        
      } elseif ($cr->status_id == 'S5') {
        $user           = User::where('id', $request->user_id)->first();
        if ($user_auth->tipe_user_id == 'BAS' AND $user_auth->id == $cr->it_operator) { //Basis
          Cr::where('id', $id)->update(['status_id' => $request->status_id, 'current' => $cr->user_id]); 
          $log = Log::create([
            'cr_id' => $id,
            'log'   => Auth::user()->nama_lengkap. ' - Status sudah di tetapkan menjadi "Ready to Testing In QA"'    
          ]);
          Notification::route('mail', $user->email)->notify(new CrNotification($cr, $user, $project, $status));
        } else {
          return back()->with('error','Anda tidak diperbolehkan merubah ke tahap selanjutnya');
        }
      } elseif ($cr->status_id == 'S6') {
        $user           = User::where('id', $request->it_operator)->first();
        if ($user_auth->tipe_user_id == 'USE' AND $user_auth->id == $cr->user_id) { //End User
          Cr::where('id', $id)->update(['status_id' => $request->status_id, 'current' => $cr->it_operator]); 
          $log = Log::create([
            'cr_id' => $id,
            'log'   => Auth::user()->nama_lengkap. ' - Status sudah di tetapkan menjadi "Sucessfully Tested In QA"'    
          ]);
          Notification::route('mail', $user->email)->notify(new CrNotification($cr, $user, $project, $status));
        } else {
          return back()->with('error','Anda tidak diperbolehkan merubah ke tahap selanjutnya');
        }
      } elseif ($cr->status_id == 'S7') {
        $user           = User::where('id', $request->user_id)->first();
        if ($user_auth->tipe_user_id == 'BAS' AND $user_auth->id == $cr->it_operator) { //Basis
          Cr::where('id', $id)->update(['status_id' => $request->status_id, 'current' => $cr->user_id]);
          $log = Log::create([
            'cr_id' => $id,
            'log'   => Auth::user()->nama_lengkap. ' - Status sudah di tetapkan menjadi "Impoerted into PROD"'    
          ]);
          Notification::route('mail', $user->email)->notify(new CrNotification($cr, $user, $project, $status));
        } else {
          return back()->with('error','Anda tidak diperbolehkan merubah ke tahap selanjutnya');
        }
      }
      return back()->with('success','Permintaan perubahan berhasil dirubah');
    }

    public function status_1(Request $request, $id) {
      $user_auth      = Auth::user();
      $cr             = Cr::where('id', $id)->first();
      
      $project        = Project::where('id', $request->proyek_id)->first();
      $status         = Status::where('id', $request->status_id)->first();
      if ($cr->status_id == 'S4') {
        $user           = User::where('id', $request->developer)->first();
        if ($user_auth->tipe_user_id == 'FUN' AND $user_auth->id == $cr->tester) { //Tester
          if ($request->developer == '') {
            return back()->with('error','Anda belum memilih Abaper / Developer');
          }
          Cr::where('id', $id)->update(['status_id' => $request->status_id, 'current' => $cr->developer]);
          $log = Log::create([
            'cr_id' => $id,
            'log'   => Auth::user()->nama_lengkap. ' - Status di kembalikan ke "In to Development"'    
          ]);
          Notification::send($user, new CrNotification1($cr, $user, $project, $status));
        } else {
          return back()->with('error','Anda tidak diperbolehkan merubah ke tahap selanjutnya');
        }
      } elseif ($cr->status_id == 'S6') {
        $user           = User::where('id', $request->developer)->first();
        if ($user_auth->tipe_user_id == 'USE' AND $user_auth->id == $cr->user_id) { //End User
          Cr::where('id', $id)->update(['status_id' => $status->id, 'current' => $cr->developer]);
          $log = Log::create([
            'cr_id' => $id,
            'log'   => Auth::user()->nama_lengkap. ' - Status di kembalikan ke "In to Development"'    
          ]);
          Notification::route('mail', $user->email)->notify(new CrNotification1($cr, $user, $project, $status));
        } else {
          return back()->with('error','Anda tidak diperbolehkan merubah ke tahap selanjutnya');
        }
      }
      return back()->with('success','Permintaan perubahan berhasil dirubah');
    }
    
    public function upload(Request $request) {
      $attachment = Attachment::create($request->all());
      $file = $request->file('file');
      $path = public_path('');
      
      // if ($request->attachment_id == 1) {
      //   $path = 'documents\functional_spec';
      // } elseif ($request->attachment_id == 2) {
      //   $path = 'documents\technical_spec';
      // } elseif ($request->attachment_id > 2) {
      //   $path = 'documents\others_doc';
      // }
      $file->move($path, $file->getClientOriginalName());
      $attachment->path = $file->getClientOriginalName();
      $log = Log::create([
        'cr_id' => $request->cr_id,
        'log'   => Auth::user()->nama_lengkap.' - Upload File '. $request->attachment_id . $request->nama_file   
      ]);
      $attachment->save();
      
      // if($request->hasfile('file')) {
      //   $path = $request->file('file')->store('file');
      //   $attachment->path = $path;
      //   $attachment->save();
      // }
      return back()->with('success','Dokumen berhasil di-upload');
    }

    public function download($file) {
    	$filePath = public_path($file);
      $headers = ['Content-Type: application/msword'];
    	$fileName = time().'.docx';

      return response()->download($filePath, $file, $headers);
    }

    public function destroy_attachment($id) {
      $attachment = Attachment::where('id', $id)->first();
	    File::delete(''. $attachment->path);
 
	    // hapus data
	    Attachment::where('id', $id)->delete();
 
	    return redirect()->back();
    }
}
