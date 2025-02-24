<?php

namespace App\Http\Controllers;

use App\Models\Paket;
use Illuminate\Http\Request;

class PaketController extends Controller
{
    public function index()
    {
        $paket = Paket::paginate(5);
        return view('page.paket.index')->with([
            'paket' => $paket
        ]);
    }
    public function store(Request $request)
    {
        $data = [
            'nama_paket' => $request->input('nama_paket'),
            'harga' => $request->input('harga'),
            'deskripsi' => $request->input('deskripsi'),
        ];

        Paket::create($data);

        return back()->with('message_delete', 'Data Supplier Sudah dihapus');
    }
    
    public function update(Request $request, string $id)
    {
        $data = [
            'nama_paket' => $request->input('nama_paket'),
            'harga' => $request->input('harga'),
            'deskripsi' => $request->input('deskripsi'),
        ];

        $datas = Paket::findOrFail($id);
        $datas->update($data);
        return back()->with('message_delete', 'Data Supplier Sudah dihapus');
    }

    public function destroy(string $id)
    {
        $data = Paket::findOrFail($id);
        $data->delete();
        return back()->with('message_delete','Data Supplier Sudah dihapus');
    }
}
