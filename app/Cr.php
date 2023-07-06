<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cr extends Model
{
    // use HasFactory;
    protected $fillable = ['id', 'user_id', 'modul_id', 'status_id'];
    protected $table = 'change_requests';

    public static function boot(){
        parent::boot();
        self::creating(function ($model) {
            $model->uuid = IdGenerator::generate(['table' => $this->table, 'length' => 6, 'prefix' =>date('y')]);
        });
    }

    public function proyek()
    {
      return $this->belongsTo('App\modul', 'proyek_id');
    }

    public function user()
    {
      return $this->belongsTo('App\User', 'user_id');
    }

    public function modul()
    {
      return $this->belongsTo('App\modul', 'modul_id');
    }
}
