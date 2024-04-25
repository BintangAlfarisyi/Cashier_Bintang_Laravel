<?php

namespace App\Http\Controllers;

use App\Models\Registrasi;
use App\Http\Requests\StoreRegistrasiRequest;
use App\Http\Requests\UpdateRegistrasiRequest;
use Illuminate\Http\Request;
use App\Models\User;

class RegistrasiController extends Controller
{
    public function registrasi()
    {
        return view('auth.registrasi');
    }

    public function register(Request $request)
    {
        // Validasi data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'level' => 'required',
            'alamat' => 'required',
            'ponsel' => 'required',
        ]);

        // Buat user baru
        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => bcrypt($validatedData['password']),
            'level' => $validatedData['level'],
            'alamat' => $validatedData['alamat'],
            'ponsel' => $validatedData['ponsel'],
        ]);

        // Otentikasi user
        auth()->login($user);

        // Redirect ke halaman login dengan pesan sukses
        return redirect('/login')->with('success', 'Akun Anda telah berhasil dibuat. Silakan login.');
    }
}
