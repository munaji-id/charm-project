<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipeUser extends Model
{
    // use HasFactory;
    // public $primaryKey = 'id';
    public $incrementing = false;
    protected $fillable = ['id', 'nama_tipe_user', 'deskripsi'];
    protected $table = 'tipe_users';

    public function user()
    {
      return $this->hasMany('App\User');
    }
}