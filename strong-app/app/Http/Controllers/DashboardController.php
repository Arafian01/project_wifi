<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pelanggan;
use App\Models\Tagihan;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class DashboardController extends Controller
{
    public function index()
    {
        $now = Carbon::now();

        // Jumlah pelanggan berdasarkan status
        $pelangganStatus = Pelanggan::select('status', DB::raw('count(*) as total'))
            ->groupBy('status')
            ->pluck('total', 'status');

        // Tagihan bulan ini berdasarkan status
        $tagihanStatus = Tagihan::whereMonth('tanggal', $now->month)
            ->whereYear('tanggal', $now->year)
            ->select('status_pembayaran', DB::raw('count(*) as total'))
            ->groupBy('status_pembayaran')
            ->pluck('total', 'status_pembayaran');

        // Penghasilan bulan ini dari tagihan yang lunas
        $penghasilanBulanIni = Tagihan::all();

        return view('/', compact('pelangganStatus', 'tagihanStatus', 'penghasilanBulanIni'));
    }
}
