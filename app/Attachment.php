<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attachment extends Model
{
    use HasFactory;
    protected $fillable = ['cr_id', 'attachment_id', 'nama_file', 'path'];
    protected $table = 'attachments';

    public function tipeattacment()
    {
      return $this->belongsTo('App\TipeAttachment', 'attachment_id');
    }
}
