<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        // 1. Validasi data: Pastikan Nama, NIM, Email, dan Password diisi dengan benar
        $request->validate([
            'name' => 'required',
            'nim' => 'required|unique:users,nim', // Ditambahkan: NIM wajib diisi dan tidak boleh kembar
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6'
        ]);

        // 2. Simpan data ke tabel 'users' di database
        $user = User::create([
            'name' => $request->name,
            'nim' => $request->nim, // Ditambahkan: Menyimpan NIM mahasiswa ke database
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        // 3. Ditambahkan: Begitu selesai daftar, langsung buatkan token (Kunci Akses)
        $token = $user->createToken('auth_token')->plainTextToken;

        // 4. Kirim respon sukses beserta Token-nya ke Flutter
        return response()->json([
            'success' => true,
            'message' => 'Register berhasil',
            'token' => $token, // Ditambahkan: Sekarang register juga mengembalikan token
            'data' => $user
        ], 201);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $user = User::where('email', $request->email)->first();

        // Cek apakah user ada di database & password-nya cocok
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'message' => 'Email atau password salah'
            ], 401);
        }

        // Buat token baru setelah sukses login
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'Login berhasil',
            'token' => $token,
            'data' => $user // Ditambahkan: Mengirim data user agar Flutter tahu Nama & NIM yang sedang login
        ]);
    }

    public function logout(Request $request)
    {
        // Hapus token yang sedang digunakan saat ini
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Logout berhasil'
        ]);
    }
}