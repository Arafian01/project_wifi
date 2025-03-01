<?php

namespace App\Http\Controllers;

use App\Models\Notifikasi;
use App\Models\Status_baca;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotifikasiController extends Controller {
    public function index() {
        $user = Auth::user();
        $notifikasis = Notifikasi::latest()->get();
        
        // Ambil ID notifikasi yang sudah dibaca oleh user
        $dibaca = Status_baca::where('user_id', $user->id)->pluck('notifikasi_id')->toArray();

        // Tandai semua notifikasi sebagai terbaca jika belum ada di status baca
        foreach ($notifikasis as $notifikasi) {
            if (!in_array($notifikasi->id, $dibaca)) {
                Status_baca::firstOrCreate([
                    'notifikasi_id' => $notifikasi->id,
                    'user_id' => $user->id
                ]);
            }
        }

        return view('page.notifikasi.index', compact('notifikasis', 'dibaca'));
    }

    public function store(Request $request) {
        $request->validate([
            'judul' => 'required|string|max:255',
            'pesan' => 'required|string',
        ]);

        Notifikasi::create($request->all());

        return redirect()->route('notifikasi.index')->with('success', 'Notifikasi berhasil dibuat');
    }
}