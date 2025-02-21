<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Paket;
use App\Models\Pelanggan;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        $pakets = Paket::all();
        return view('auth.register')->with('paket', $pakets);
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', Rules\Password::defaults()],
            'telepon' => ['required', 'string', 'max:15'],
            'alamat' => ['required', 'string', 'max:255'],
            'paket_id' => ['required', 'exists:paket,id'], 
        ]);
    
        DB::beginTransaction(); 
    
        try {
            $user = User::create([
                'nama' => $request->nama, // Simpan nama di tabel pelanggan, bukan users
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => 'pelanggan',
            ]);
    
            Pelanggan::create([
                'user_id' => $user->id,
                'paket_id' => $request->paket_id,
                'telepon' => $request->telepon,
                'alamat' => $request->alamat,
                'status' => 'nonaktif',
            ]);
    
            DB::commit(); // Simpan data ke database
    
            event(new Registered($user));
    
            Auth::login($user);
    
            return redirect()->route('dashboard');
        } catch (\Exception $e) {
            DB::rollBack(); // Batalkan jika ada error
            return back()->withErrors(['error' => 'Terjadi kesalahan saat registrasi.']);
        }
    }
}
