<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    // Menampilkan halaman form pendaftaran
    public function showRegistrationForm()
    {
        return view('auth.register'); // Pastikan anda punya file resources/views/auth/register.blade.php
    }

    // Memproses data pendaftaran
    public function register(Request $request)
    {
        // 1. Validasi Input
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        // 2. Simpan ke Database
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password), // Enkripsi password
        ]);

        // 3. Langsung Login setelah daftar
        Auth::login($user);

        // 4. Redirect ke halaman home atau dashboard
        return redirect()->route('home')->with('success', 'Pendaftaran berhasil!');
    }
}