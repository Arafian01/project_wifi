<?php

namespace App\Http\Controllers;

use App\Models\pelanggan;
use App\Models\tagihan;
use App\Models\User;
use Illuminate\Http\Request;

class TagihanController extends Controller
{
    public function index()
    {
        $tagihan = tagihan::paginate(5);
        $user = User::all();
        $pelanggan = pelanggan::all();
        return view('page.tagihan.index')->with([
            'tagihan' => $tagihan,
            'pelanggan' => $pelanggan,
            'user' => $user
        ]);
    }

    public function store(Request $request)
    {
        $data = [
            'pelanggan_id' => $request->input('pelanggan_id'),
            'bulan_tahun' => $request->input('bulan_tahun'),
            'status_pembayaran' => $request->input('status_pembayaran'),
            'jatuh_tempo' => $request->input('jatuh_tempo'),
        ];

        tagihan::create($data);

        return back()->with('message_delete', 'Data Supplier Sudah dihapus');
    }

    public function update(Request $request, string $id)
    {
        $data = [
            'pelanggan_id' => $request->input('pelanggan_id'),
            'bulan_tahun' => $request->input('bulan_tahun'),
            'status_pembayaran' => $request->input('status_pembayaran'),
            'jatuh_tempo' => $request->input('jatuh_tempo'),
        ];

        $datas = tagihan::findOrFail($id);
        $datas->update($data);
        return back()->with('message_delete', 'Data Supplier Sudah dihapus');
    }

    public function destroy($id)
    {   
        $data = tagihan::findOrFail($id);
        $data->delete();
        return back()->with('message_delete','Data Supplier Sudah dihapus');
    }
}
