<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipeAttachment extends Model
{
    // use HasFactory;
    public $incrementing = false;

    protected $fillable = ['id', 'nama_tipe_attachment', 'deskripsi'];
    protected $table = 'tipe_attachments';
}
