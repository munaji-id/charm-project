<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Modul extends Model
{
    // use HasFactory;
    public $primaryKey = 'id';
    public $incrementing = false;
    protected $fillable = ['id', 'nama_modul', 'deskripsi'];
    protected $table = 'moduls';

    public function project()
    {
      return $this->hasMany('App\Project');
    }

    // public function project_modul()
    // {
    //   return $this->hasMany('App\ProjectModul');
    // }

    // public function project_modul()
    // {
    //   return $this->belongsTo('App\ProjectModul', 'proyek_id');
    // } 
}
