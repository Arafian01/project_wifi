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
        $data = [
            'user_id' => $request->input('user_id'),
            'paket_id' => $request->input('paket_id'),
            'alamat' => $request->input('alamat'),
            'telepon' => $request->input('telepon'),
            'tanggal_langganan' => $request->input('tanggal_langganan'),
            'status' => $request->input('status'),
        ];

        pelanggan::create($data);

        return back()->with('message_delete', 'Data Supplier Sudah dihapus');
    }
}
