<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use  HasApiTokens, HasFactory, Notifiable;
    protected $table = 'users';
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['tipe_user_id', 'perusahaan_id', 'name', 'email', 'password', 'nama_lengkap', 'kontak', 'last_seen'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // public static function boot()
    // {
    //   parent::boot();
    //   static::creating(function ($model) {
    //     $model->user_id = Auth()->user()->id;
    //     return true;
    //   });
    // }

    public function company()
    {
      return $this->belongsTo('App\Company', 'perusahaan_id');
    }

    public function tipeuser()
    {
      return $this->belongsTo('App\TipeUser', 'tipe_user_id');
    }

    public function cr()
    {
      return $this->hasMany('App\Cr');
    }
}
