<?php

namespace App\Http\Controllers;

use App\Models\paket;
use Illuminate\Http\Request;

class PaketController extends Controller
{
    public function index()
    {
        $paket = paket::paginate(5);
        return view('page.paket.index')->with([
            'paket' => $paket
        ]);
    }

    public function store(Request $request)
    {
        $data = [
            'nama_paket' => $request->input('nama'),
            'harga' => $request->input('harga'),
            'deskripsi' => $request->input('deskripsi'),

        ];

        paket::create($data);

        return back()->with('message_delete', 'Data Supplier Sudah dihapus');
    }

    public function update(Request $request, string $id)
    {
        $data = [
            'nama_paket' => $request->input('nama'),
            'harga' => $request->input('harga'),
            'deskripsi' => $request->input('deskripsi'),'nama' => $request->input('nama'),
        ];

        $datas = paket::findOrFail($id);
        $datas->update($data);
        return back()->with('message_delete', 'Data Supplier Sudah dihapus');
    }

    public function destroy($id)
    {   
        $data = paket::findOrFail($id);
        $data->delete();
        return back()->with('message_delete','Data Supplier Sudah dihapus');
    }
}
