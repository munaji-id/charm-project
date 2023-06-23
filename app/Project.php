<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    // use HasFactory;
    protected $fillable = ['nama_proyek','mulai', 'selesai'];
    protected $table = 'projects';
    protected $primaryKey = 'id';

    public function company()
    {
      return $this->belongsTo('App\Company', 'perusahaan_id');
    }

    public function modul()
    {
      return $this->belongsTo('App\Modul', 'modul_id');
    }
}
