<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;
use App\Models\Pelanggan;
use App\Models\Tagihan;

class GenerateTagihan extends Command
{
    protected $signature = 'tagihan:generate'; // Nama perintah artisan
    protected $description = 'Membuat tagihan otomatis untuk pelanggan aktif';

    public function handle()
    {
        $tanggal = Carbon::now()->endOfMonth();
        $pelangganAktif = Pelanggan::where('status', 'aktif')->get();

        foreach ($pelangganAktif as $pelanggan) {
            Tagihan::create([
                'pelanggan_id' => $pelanggan->id,
                'bulan_tahun' => $tanggal->format('Y-m'),
                'status_pembayaran' => 'belum_dibayar',
                'jatuh_tempo' => Carbon::now()->addMonth()->startOfMonth()->addDays(4)->format('Y-m-d'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        $this->info('Tagihan berhasil dibuat untuk semua pelanggan aktif.');
    }
}
