<?php

namespace App\Http\Controllers;

use App\Models\Paket;
use App\Models\pelanggan;
use App\Models\User;
use Illuminate\Http\Request;

class PelangganController extends Controller
{
    public function index()
    {
        $pelanggan = pelanggan::paginate(5);
        $user = User::all();
        $paket = Paket::all();
        return view('page.pelanggan.index')->with([
            'user' => $user,
            'pelanggan' => $pelanggan,
            'paket' => $paket
        ]);
    }

    public function store(Request $request)
    {
        $datauser = User::create([
            'name' => $request->input('name'),
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
            'tanggal_langganan' => $request->input('tanggal_langganan'),
        ]);

        return back()->with('message_success', 'Data Pelanggan Berhasil Ditambahkan');
    }
}
