<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notifikasi extends Model
{
    protected $fillable = [
        'judul',
        'pesan',
    ];

    protected $table = 'notifikasis';
}