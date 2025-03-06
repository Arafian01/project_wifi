<?php

namespace App\Http\Controllers;

use App\Models\Paket;
use App\Models\Pelanggan;
use App\Models\pembayaran;
use App\Models\tagihan;
use App\Models\User;
use Illuminate\Http\Request;

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
            'tagihan' => $tagihan
        ]);
    }

    public function store(Request $request)
    {
        $datauser = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
            'role' => 'pembayaran',
        ]);

        pembayaran::create([
            'user_id' => $datauser->id,
            'paket_id' => $request->input('paket_id'),
            'alamat' => $request->input('alamat'),
            'telepon' => $request->input('telepon'),
            'status' => $request->input('status'),
            'tanggal_langganan' => $request->input('tanggal_langganan'),
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
        $datauser = User::findOrFail($data->user_id);
        $datauser->delete();
        $data->delete();
        return back()->with('message_success', 'pembayaran berhasil dihapus');
    }
}
