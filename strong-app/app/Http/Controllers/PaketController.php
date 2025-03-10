<?php

namespace App\Http\Controllers;

use App\Models\paket;
use Illuminate\Http\Request;

class PaketController extends Controller
{
    public function index()
    {
        try {
            $paket = paket::paginate(5);
            return view('page.pakett.index')->with([
                'paket' => $paket
            ]);
        }catch(\Exception $e){
            echo "<script>console.error('PHP Error: " . addslashes($e->getMessage()) . "');</script>";
            return view('error.index');
        }
        
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
            'deskripsi' => $request->input('deskripsi'),
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
