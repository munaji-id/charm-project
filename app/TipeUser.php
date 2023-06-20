<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipeUser extends Model
{
    use HasFactory;

    public function user()
    {
      return $this->hasMany('App\User');
    }
}
