<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class notifikasi extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_role',
        'judul',
        'pesan',
    ];

    protected $table = 'notifikasis';

    public function role()
    {
        return $this->belongsTo(Role::class);
    }
}
