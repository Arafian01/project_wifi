<?php

namespace App\Http\Controllers;

use App\Models\pelanggan;
use App\Models\tagihan;
use App\Models\User;
use Illuminate\Http\Request;

class laporanController extends Controller
{
    public function index()
    {
        return view('admin.page.laporan.index');
    }
    public function store(Request $request)
    {
        $tagihan = tagihan::all();
        $pelanggan = pelanggan::all();
        $user = User::all();
        $bulan_tahun = $request->input('bulan_tahun');

        $laporan = tagihan::whereBetween('bulan_tahun', [$bulan_tahun])->get();

        return view('laporan.printLaporan', compact('laporan', 'tagihan', 'pelanggan', 'user'));
    }
}
