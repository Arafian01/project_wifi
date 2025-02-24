<?php

namespace App\Http\Controllers;

use App\Models\Paket;
use App\Models\Pelanggan;
use App\Models\User;
use Illuminate\Http\Request;

class PelangganController extends Controller
{
    public function index()
    {
        $pelanggan = Pelanggan::paginate(10);
        $pakets = Paket::all();
        $users = User::all();
        return view('page.pelanggan.index')->with([
            'pelanggan' => $pelanggan,
            'pakets' => $pakets,
            'users' => $users,
        ]);
    }

    public function store(Request $request)
    {
        $datauser = User::create([
            'nama' => $request->input('nama'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
            'role' => 'pelanggan',
        ]);

        Pelanggan::create([
            'user_id' => $datauser->id,
            'paket_id' => $request->input('paket_id'),
            'alamat' => $request->input('alamat'),
            'telepon' => $request->input('telepon'),
            'status' => $request->input('status'),
        ]);

        return back()->with('message_success', 'Data Pelanggan Berhasil Ditambahkan');
    }

    public function update(Request $request, String $id)
    {
        

        $pelanggan = Pelanggan::findOrFail($id);
        $pelanggan->update([
            'paket_id' => $request->input('paket_id'),
            'alamat' => $request->input('alamat'),
            'telepon' => $request->input('telepon'),
            'status' => $request->input('status'),
        ]);

        $user = User::where('id', $request->input('user_id'))->first();
        
        if($request->input('password') == ""){
            $datapassword = $user->password;
        } else {
            $datapassword = $request->input('password');
        };

        $user->update([
            'nama' => $request->input('nama'),
            'email' => $request->input('email'),
            'password' => $datapassword,
        ]);

        return back()->with('message_success', 'Data Pelanggan Berhasil Ditambahkan');

    }
    public function destroy(Pelanggan $pelanggan)
    {
        $pelanggan->delete();
        return redirect()->route('page.pelanggan.index')->with('success', 'Pelanggan berhasil dihapus');
    }
}
