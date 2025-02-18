<?php

namespace App\Http\Controllers;

use App\Models\Paket;
use App\Models\Pelanggan;
use App\Models\User;
use Illuminate\Http\Request;

class PelangganController extends Controller
{
    public function index()
    {
        $pelanggan = Pelanggan::paginate(10);
        $pakets = Paket::all();
        $users = User::all();
        return view('page.pelanggan.index', compact('pelanggan', 'pakets', 'users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'paket_id' => 'required',
            'nama' => 'required',
            'alamat' => 'required',
            'telepon' => 'required',
            'status' => 'required',
        ]);
        Pelanggan::create($request->all());
        return redirect()->route('page.pelanggan.index')->with('success', 'Pelanggan berhasil ditambahkan');
    }

    public function update(Request $request, Pelanggan $pelanggan)
    {
        $request->validate([
            'user_id' => 'required',
            'paket_id' => 'required',
            'nama' => 'required',
            'alamat' => 'required',
            'telepon' => 'required',
            'status' => 'required',
        ]);
        $pelanggan->update($request->all());
        return redirect()->route('page.pelanggan.index')->with('success', 'Pelanggan berhasil diupdate');
    }
    public function destroy(Pelanggan $pelanggan)
    {
        $pelanggan->delete();
        return redirect()->route('page.pelanggan.index')->with('success', 'Pelanggan berhasil dihapus');
    }
}
