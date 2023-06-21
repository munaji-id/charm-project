<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Company extends Model
{
    use Notifiable;

    // use HasFactory;
    protected $fillable = ['nama_perusahaan', 'alamat'];
    protected $table = 'companies';

    public function user()
    {
      return $this->hasMany('App\User');
    }
}
