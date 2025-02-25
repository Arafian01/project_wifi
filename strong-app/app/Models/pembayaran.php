<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pembayaran extends Model
{
    use HasFactory;

    protected $fillable = [
        'tagihan_id',
        'image',
        'tanggal_kirim'
    ];

    protected $table = 'pembayarans';

    public function tagihan()
    {
        return $this->belongsTo(tagihan::class);
    }

    public function riwayat_pembayaran()
    {
        return $this->hasMany(riwayat_pembayaran::class);
    }

}
