<?php

namespace App\Http\Controllers;

use App\Models\Paket;
use Illuminate\Http\Request;

class PaketController extends Controller
{
    // Menampilkan semua data paket
    public function index()
    {
        $pakets = Paket::all();
        return response()->json($pakets);
    }

    // Menambahkan data paket baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_paket' => 'required|string|max:255',
            'harga' => 'required|numeric',
        ]);

        $paket = Paket::create($validated);
        return response()->json($paket, 201);
    }

    // Menampilkan detail data paket
    public function show($id)
    {
        $paket = Paket::findOrFail($id);
        return response()->json($paket);
    }

    // Mengupdate data paket
    public function update(Request $request, $id)
    {
        $paket = Paket::findOrFail($id);

        $validated = $request->validate([
            'nama_paket' => 'required|string|max:255',
            'harga' => 'required|numeric',
        ]);

        $paket->update($validated);
        return response()->json($paket);
    }

    // Menghapus data paket
    public function destroy($id)
    {
        $paket = Paket::findOrFail($id);
        $paket->delete();

        return response()->json(['message' => 'Paket deleted successfully']);
    }
}
