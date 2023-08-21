<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectModul extends Model
{
    // use HasFactory;
    protected $fillable = ['proyek_id', 'modul_id'];
    protected $table = 'project_moduls';
    protected $primaryKey = ['proyek_id', 'modul_id'];

    public $incrementing = false;

    protected $keyType = 'string';


    public function project()
    {
      return $this->hasMany('App\Project');
    }

    public function modul()
    {
      return $this->belongsTo('App\Modul', 'modul_id');
    }

    public function cr()
    {
      return $this->hasMany('App\Cr');
    }
}
