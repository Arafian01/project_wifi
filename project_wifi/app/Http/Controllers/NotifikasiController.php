<?php

namespace App\Http\Controllers;

use App\Models\Notifikasi;
use Illuminate\Http\Request;

class NotifikasiController extends Controller
{
    public function index()
    {
        
        $notifikasis = Notifikasi::latest()->get();
        return view('page.notifikasi.index', compact('notifikasis'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'pesan' => 'required|string',
        ]);

        Notifikasi::create([
            'judul' => $request->judul,
            'pesan' => $request->pesan,
        ]);

        return redirect()->route('notifikasi.index')->with('success', 'Notifikasi berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'pesan' => 'required|string',
        ]);

        $notifikasi = Notifikasi::findOrFail($id);
        $notifikasi->update([
            'judul' => $request->judul,
            'pesan' => $request->pesan,
        ]);

        return redirect()->route('notifikasi.index')->with('success', 'Notifikasi berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $notifikasi = Notifikasi::findOrFail($id);
        $notifikasi->delete();

        return redirect()->route('notifikasi.index')->with('success', 'Notifikasi berhasil dihapus.');
    }
}
