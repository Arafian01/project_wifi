<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class paket extends Model
{
    protected $fillable = [
        'nama_paket',
        'harga',
        'deskripsi',
    ];

    protected $table = 'paket';
    public function pelanggan()
    {
        return $this->hasMany(Pelanggan::class, 'paket_id');
    }
}
