<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Modul extends Model
{
    // use HasFactory;
    protected $fillable = ['nama_modul', 'deskripsi'];
    protected $table = 'moduls';

    public function project()
    {
      return $this->hasMany('App\Project');
    }
}
