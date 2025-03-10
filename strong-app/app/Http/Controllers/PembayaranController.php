<?php

namespace App\Http\Controllers;

use App\Models\Paket;
use App\Models\Pelanggan;
use App\Models\pembayaran;
use App\Models\tagihan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PembayaranController extends Controller
{
    public function index()
    {
        $pembayaran = pembayaran::paginate(5);
        $user = User::all();
        $paket = Paket::all();
        $pelanggan = Pelanggan::all();
        $tagihan = tagihan::all();

        return view('page.pembayaran.index')->with([
            'user' => $user,
            'pembayaran' => $pembayaran,
            'paket' => $paket,
            'pelanggan' => $pelanggan,
            'tagihan' => $tagihan,
        ]);
    }

    public function store(Request $request)
    {
        $data = [
            'user_id' => Auth::user()->id,
            'tagihan_id' => $request->input('tagihan_id'),
            'image' => $request->input('image'),
            'tanggal_kirim' => $request->input('tanggal_kirim'),
            'status_verifikasi' => $request->input('status_verifikasi'),
            'tanggal_verifikasi' => $request->input('tanggal_verifikasi'),
        ];

        pembayaran::create($data);

        return back()->with('message_success', 'Data pembayaran Berhasil Ditambahkan');
    }
    public function update(Request $request, String $id)
    {
        

        $pembayaran = pembayaran::findOrFail($id);
        $pembayaran->update([
            'paket_id' => $request->input('paket_id'),
            'alamat' => $request->input('alamat'),
            'telepon' => $request->input('telepon'),
            'status' => $request->input('status'),
            'tanggal_langganan' => $request->input('tanggal_langganan'),
        ]);

        $user = User::where('id', $pembayaran->user_id)->first();
        
        if($request->input('password') == ""){
            $datapassword = $user->password;
        } else {
            $datapassword = $request->input('password');
        };

        $user->update([
            'name' => $request->input('nama'),
            'email' => $request->input('email'),
            'password' => $datapassword,
            'role' => 'pembayaran',

        ]);

        return back()->with('message_success', 'Data pembayaran Berhasil Ditambahkan');

    }
    public function destroy($id)
    {
        $data = pembayaran::findOrFail($id);
        $datauser = User::findOrFail($data->user_id);
        $datauser->delete();
        $data->delete();
        return back()->with('message_success', 'pembayaran berhasil dihapus');
    }
}
