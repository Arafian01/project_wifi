<?php

namespace App\Http\Controllers;

use App\Models\Notifikasi;
use App\Models\Status_baca;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotifikasiController extends Controller
{
    public function index()
    {
        try {
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

            $isRead = \App\Models\status_baca::where('user_id', $user->id)
                ->where('notifikasi_id', $notifikasi->id)
                ->exists();

            return view('page.notifikasi.index', compact('notifikasis', 'dibaca', 'isRead'));
        } catch (\Exception $e) {
            echo "<script>console.error('PHP Error: " . addslashes($e->getMessage()) . "');</script>";
            return view('error.index');
        }
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'judul' => 'required|string|max:255',
                'pesan' => 'required|string',
            ]);

            Notifikasi::create($request->all());

            return redirect()
                ->route('notifikasi.index')->with('message_insert', 'Notifikasi berhasil dibuat');
        } catch (\Exception $e) {
            return redirect()
                ->route('notifikasi.index')->with('error_message', 'terjadi kesalahan saat menambahkan data: ' . $e->getMessage());
        };
    }

    public function edit($id) {}

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'judul' => 'required|string|max:255',
                'pesan' => 'required|string',
            ]);

            $notifikasi = Notifikasi::findOrFail($id);
            $notifikasi->update([
                'judul' => $request->judul,
                'pesan' => $request->pesan,
            ]);

            return redirect()
                ->route('notifikasi.index')->with('message_insert', 'Notifikasi berhasil diperbarui!');
        } catch (\Exception $e) {
            return redirect()
                ->route('notifikasi.index')->with('error_message', 'terjadi kesalahan saat menambahkan data: ' . $e->getMessage());
        };
    }

    public function destroy($id)
    {
        try {
            $notifikasi = Notifikasi::findOrFail($id);
            $notifikasi->delete();

            return back()->with('message_delete', 'Notifikasi berhasil dihapus!');
        } catch (\Exception $e) {
            return back()->with('error_mesaage', 'Terjadi kesalahan saat melakukan delete data: ' . $e->getMessage());
        }
    }
}
