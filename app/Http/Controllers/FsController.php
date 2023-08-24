<?php

namespace App\Http\Controllers;

use App\Attachment;
use Illuminate\Http\Request;

class FsController extends Controller
{
    public function index()
    {
      $data['title']  = 'Dokumen';      
      $attachments  = Attachment::all();
      return view('pages.fs.index', compact('attachments'), $data);
    }
}
