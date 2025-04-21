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
        try {
            $tagihan = tagihan::paginate(5);
            $user = User::all();
            $pelanggan = pelanggan::all();
            return view('admin.page.tagihan.index')->with([
                'tagihan' => $tagihan,
                'pelanggan' => $pelanggan,
                'user' => $user
            ]);
        } catch (\Exception $e) {
            return redirect()->route('error.index')->with('error_message', 'Error: ' . $e->getMessage());
        }
    }

    public function store(Request $request)
    {
        try {
            $data = [
                'pelanggan_id' => $request->input('pelanggan_id'),
                'bulan_tahun' => $request->input('bulan_tahun'),
                'status_pembayaran' => $request->input('status_pembayaran'),
                'jatuh_tempo' => $request->input('jatuh_tempo'),
            ];

            tagihan::create($data);

            return back()->with('message_delete', 'Data Supplier Sudah dihapus');
        } catch (\Exception $e) {
            return redirect()->route('error.index')->with('error_message', 'Error: ' . $e->getMessage());
        }
    }

    public function update(Request $request, string $id)
    {
        try {
            $data = [
                'pelanggan_id' => $request->input('pelanggan_id'),
                'bulan_tahun' => $request->input('bulan_tahun'),
                'status_pembayaran' => $request->input('status_pembayaran'),
                'jatuh_tempo' => $request->input('jatuh_tempo'),
            ];

            $datas = tagihan::findOrFail($id);
            $datas->update($data);
            return back()->with('message_delete', 'Data Supplier Sudah dihapus');
        } catch (\Exception $e) {
            return redirect()->route('error.index')->with('error_message', 'Error: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $data = tagihan::findOrFail($id);
            $data->delete();
            return back()->with('message_delete', 'Data Supplier Sudah dihapus');
        } catch (\Exception $e) {
            return redirect()->route('error.index')->with('error_message', 'Error: ' . $e->getMessage());
        }
    }
}
