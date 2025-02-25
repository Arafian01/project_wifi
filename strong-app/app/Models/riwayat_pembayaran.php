<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class riwayat_pembayaran extends Model
{
    use HasFactory;

    protected $fillable = [
        'pembayaran_id',
        'user_id',
        'status_verifikasi',
        'tanggal_verifikasi'
    ];

    protected $table = 'riwayat_pembayarans';

    public function pembayaran()
    {
        return $this->belongsTo(pembayaran::class);
    }

    public function user()
    {
        return $this->belongsTo(user::class);
    }
}
