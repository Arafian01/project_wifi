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
        $tagihan = tagihan::where('status_pembayaran', 'belum_dibayar')->get();

        return view('admin.page.pembayaran.index', compact('pembayaran', 'user', 'paket', 'pelanggan', 'tagihan'));
    }

    public function store(Request $request)
    {
        $tanggal = null;
        if ($request->input('status_verifikasi') == 'diterima') {
            $tanggal = now();
        } elseif ($request->input('status_verifikasi') == 'ditolak') {
            $tanggal = now();
        } else {
            $tanggal = null;
        }

        $data = [
            'user_id' => Auth::user()->id,
            'tagihan_id' => $request->input('tagihan_id'),
            'image' => $request->input('image'),
            'tanggal_kirim' => $request->input('tanggal_kirim'),
            'status_verifikasi' => $request->input('status_verifikasi'),
            'tanggal_verifikasi' => $tanggal,
        ];

        pembayaran::create($data);

        $tagihan = tagihan::findOrFail($request->input('tagihan_id'));
        $status = null;
        if ($request->input('status_verifikasi') == 'diterima') {
            $status = 'lunas';
        } elseif ($request->input('status_verifikasi') == 'ditolak') {
            $status = 'ditolak';
        } else {
            $status = 'belum_dibayar';
        }

        $tagihan->update([
            'status_pembayaran' => $status,
        ]);

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
        $data->delete();
        return back()->with('message_success', 'pembayaran berhasil dihapus');
    }
}
