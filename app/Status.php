<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    // use HasFactory;
    protected $fillable = ['nama_status', 'deskripsi'];
    protected $table = 'status';
}
