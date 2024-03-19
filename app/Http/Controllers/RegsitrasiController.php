<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class RegsitrasiController extends Controller
{
    public function index()
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
        ]);

        // Buat user baru
        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => bcrypt($validatedData['password']),
            'level' => $validatedData['level']
        ]);

        // Otentikasi user
        // auth()->login($user);

        // Redirect ke halaman yang sesuai setelah registrasi
        return redirect('/login');
    }
}
