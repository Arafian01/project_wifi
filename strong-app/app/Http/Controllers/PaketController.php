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
            return view('page.paket.index')->with([
                'paket' => $paket
            ]);
        }catch(\Exception $e){
            echo "<script>console.error('PHP Error: " . addslashes($e->getMessage()) . "');</script>";
            return view('error.index');
        }
        
    }

    public function store(Request $request)
    {
        try {
            $data = [
                'nama_paket' => $request->input('nama'),
                'harga' => $request->input('harga'),
                'deskripsi' => $request->input('deskripsi'),
    
            ];
    
            paket::create($data);
    
            return redirect()
            ->route('paket.index')->with('message_insert', 'Data Paket Sudah ditambahkan ');
        } catch (\Exception $e) {
            return redirect()
            ->route('paket.index')->with('error_message', 'terjadi kesalahan saat menambahkan data: ' . $e->getMessage());
        };
    }

    public function update(Request $request, string $id)
    {
        try {
            $data = [
                'nama_paket' => $request->input('nama'),
                'harga' => $request->input('harga'),
                'deskripsi' => $request->input('deskripsi'),
            ];
    
            $datas = paket::findOrFail($id);
            $datas->update($data);
            return redirect()
            ->route('paket.index')->with('message_insert', 'Data Paket Berhasil diPerbarui ');
        } catch (\Exception $e) {
            return redirect()
            ->route('paket.index')->with('error_message', 'terjadi kesalahan saat menambahkan data: ' . $e->getMessage());
        };       
    }

    public function destroy($id)
    {   
        try {
            $data = paket::findOrFail($id);
            $data->delete();
            return back()->with('message_delete', 'Data Paket Berhasil DiHapus ');
        } catch(\Exception $e){
            return back()->with('error_mesaage', 'Terjadi kesalahan saat melakukan delete data: ' . $e->getMessage());
        }
        
    }
}
