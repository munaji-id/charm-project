<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class Cr extends Model
{
    // use HasFactory;
    public $primaryKey = 'id';
    public $incrementing = false;
    // protected $casts = [id' => 'string'];
    protected $fillable = ['id',
                           'user_id',
                           'proyek_id',
                           'modul_id',
                           'status_id',
                           'judul',
                           'deskripsi',
                           'developer',
                           'tester',
                           'it_operator',
                           'current',
                           'batas_waktu',
                          ];
    protected $table = 'change_requests';
    

    public static function boot(){
        parent::boot();
        self::creating(function ($model) {
            $model->id = IdGenerator::generate(['table' => 'change_requests', 'length' => 7, 'prefix' => 'CR']);
        });
    }

    public function project()
    {
      return $this->belongsTo('App\Project', 'proyek_id');
    }

    public function user()
    {
      return $this->belongsTo('App\User', 'user_id');
    }

    public function modul()
    {
      return $this->belongsTo('App\Modul', 'modul_id');
    }

    public function status()
    {
      return $this->belongsTo('App\Status', 'status_id');
    }
}
