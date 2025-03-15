<?php

namespace App\Http\Controllers;

use App\Models\Paket;
use App\Models\pelanggan;
use App\Models\User;
use Illuminate\Http\Request;

class PelangganController extends Controller
{
    public function index()
    {
        try {
            $pelanggan = pelanggan::paginate(5);
            $user = User::all();
            $paket = Paket::all();
            return view('page.pelanggan.index')->with([
                'user' => $user,
                'pelanggan' => $pelanggan,
                'paket' => $paket
            ]);
        } catch (\Exception $e) {
            echo "<script>console.error('PHP Error: " . addslashes($e->getMessage()) . "');</script>";
            return view('error.index');
        }
    }

    public function store(Request $request)
    {
        try {
            $datauser = User::create([
                'name' => $request->input('name'),
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
                'tanggal_langganan' => $request->input('tanggal_langganan'),
            ]);

            return redirect()
                ->route('pelanggan.index')->with('message_insert', 'Data pelanggan Sudah ditambahkan ');
        } catch (\Exception $e) {
            return redirect()
                ->route('pelanggan.index')->with('error_message', 'terjadi kesalahan saat menambahkan data: ' . $e->getMessage());
        };
    }
    public function update(Request $request, String $id)
    {

        try {
            $pelanggan = Pelanggan::findOrFail($id);
            $pelanggan->update([
                'paket_id' => $request->input('paket_id'),
                'alamat' => $request->input('alamat'),
                'telepon' => $request->input('telepon'),
                'status' => $request->input('status'),
                'tanggal_langganan' => $request->input('tanggal_langganan'),
            ]);

            $user = User::where('id', $pelanggan->user_id)->first();

            if ($request->input('password') == "") {
                $datapassword = $user->password;
            } else {
                $datapassword = $request->input('password');
            };

            $user->update([
                'name' => $request->input('nama'),
                'email' => $request->input('email'),
                'password' => $datapassword,
                'role' => 'pelanggan',

            ]);

            return redirect()
                ->route('pelanggan.index')->with('message_insert', 'Data pelanggan Berhasil diPerbarui ');
        } catch (\Exception $e) {
            return redirect()
                ->route('pelanggan.index')->with('error_message', 'terjadi kesalahan saat menambahkan data: ' . $e->getMessage());
        };
    }
    public function destroy($id)
    {
        try {
            $data = pelanggan::findOrFail($id);
            $datauser = User::findOrFail($data->user_id);
            $datauser->delete();
            $data->delete();
            return back()->with('message_success', 'Pelanggan berhasil dihapus');
        } catch (\Exception $e) {
            return back()->with('error_mesaage', 'Terjadi kesalahan saat melakukan delete data: ' . $e->getMessage());
        }
    }
}
