<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Pelanggan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class LoginAPIController extends Controller
{
    public function login(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validasi gagal',
                'errors' => $validator->errors()
            ], 422);
        }

        // Cek ketersediaan email
        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return response()->json([
                'status' => 'error',
                'message' => 'Email tidak terdaftar'
            ], 404);
        }

        // Cek kredensial
        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json([
                'status' => 'error',
                'message' => 'Password salah'
            ], 401);
        }

        // Cek verifikasi email
        if (!$user->hasVerifiedEmail()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Email belum diverifikasi'
            ], 403);
        }

        // Cek status aktif user
        if (!$user->is_active) {
            return response()->json([
                'status' => 'error',
                'message' => 'Akun dinonaktifkan'
            ], 403);
        }

        // Cek role dan status pelanggan
        if ($user->role === 'pelanggan') {
            $pelanggan = Pelanggan::where('user_id', $user->id)->first();

            if (!$pelanggan) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Data pelanggan tidak ditemukan'
                ], 404);
            }

            if ($pelanggan->status !== 'aktif') {
                Auth::logout();
                return response()->json([
                    'status' => 'error',
                    'message' => 'Akun pelanggan belum aktif'
                ], 403);
            }
        }

        // Generate token
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'status' => 'success',
            'message' => 'Login berhasil',
            'data' => [
                'user' => [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'role' => $user->role
                ],
                'access_token' => $token,
                'token_type' => 'Bearer'
            ]
        ]);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        
        return response()->json([
            'status' => 'success',
            'message' => 'Logout berhasil'
        ]);
    }
}
