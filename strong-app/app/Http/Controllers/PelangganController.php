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
        $pelanggan = pelanggan::paginate(5);
        $user = User::all();
        $paket = Paket::all();
        return view('page.user.index')->with([
            'user' => $user,
            'pelanggan' => $pelanggan,
            'paket' => $paket
        ]);
    }
}
