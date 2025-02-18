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
        // Validate all incoming data
        $request->validate([
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role' => ['required', 'string', 'in:admin,user,customer'],
            'paket_id' => ['required', 'exists:pakets,id'],
            'nama' => ['required', 'string', 'max:255'],
            'alamat' => ['required', 'string'],
            'telepon' => ['required', 'string', 'regex:/^\+?[0-9]{10,15}$/'],
            'status' => ['required', 'in:active,inactive'],
        ]);

        if ($request->role === '') {
            $role = 'customer';
        } else {
            $role = $request->role;
        }

        // Use a database transaction to ensure atomicity
        DB::beginTransaction();
        try {
            // Create the user
            $user = User::create([
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => $role,
            ]);

            // Create the associated customer record
            Pelanggan::create([
                'user_id' => $user->id,
                'paket_id' => $request->paket_id,
                'nama' => $request->nama,
                'alamat' => $request->alamat,
                'telepon' => $request->telepon,
                'status' => $request->status,
            ]);

            // Commit the transaction
            DB::commit();

            // Dispatch the Registered event and log in the user
            event(new Registered($user));
            Auth::login($user);

            // Redirect to the dashboard
            return redirect(route('dashboard'));
        } catch (\Exception $e) {
            // Roll back the transaction on failure
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => 'Registration failed. Please try again.']);
        }
    }
}
