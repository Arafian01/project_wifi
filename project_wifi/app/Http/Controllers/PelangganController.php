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
        return view('page.pelanggan.index')->with([
            'pelanggan' => $pelanggan,
            'pakets' => $pakets,
            'users' => $users,
        ]);
    }

    public function store(Request $request)
    {
        $datauser = User::create([
            'nama' => $request->input('nama'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
            'role' => 'pelanggan',
        ]);

        Pelanggan::create([
            'user_id' => $datauser->id,
            'paket_id' => $request->input('paket_id'),
            'alamat' => $request->input('alamat'),
            'telepon' => $request->input('telepon'),
            'status' => $request->input('status'),
        ]);

        return back()->with('message_success', 'Data Pelanggan Berhasil Ditambahkan');
    }

    public function update(Request $request, Pelanggan $pelanggan)
    {
        $request->validate([
            'user_id' => 'required',
            'paket_id' => 'required',
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
