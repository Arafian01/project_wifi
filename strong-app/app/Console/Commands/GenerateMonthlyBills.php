<?php

namespace App\Console\Commands;

use App\Models\pelanggan;
use App\Models\tagihan;
use Carbon\Carbon;
use Illuminate\Console\Command;

class GenerateMonthlyBills extends Command
{
    
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:generate-monthly-bills';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $tanggal = Carbon::now()->endOfMonth(); // Tanggal akhir bulan
        $pelangganAktif = pelanggan::where('status', 'aktif')->get();

        foreach ($pelangganAktif as $pelanggan) {
            tagihan::create([
                'pelanggan_id' => $pelanggan->id,
                'bulan_tahun' => $tanggal->format('Y-m'),
                'status_pembayaran' => 'belum bayar',
                'jatuh_tempo' => Carbon::createFromFormat('Y-m', $tanggal->format('Y-m'))->day(5), // Set tanggal 5
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        $this->info('Tagihan berhasil dibuat untuk semua pelanggan aktif.');
    }
}
