<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        if ($user = Auth::user()) {
            switch ($user->level) {
                case '1':
                    return redirect()->intended('/');
                    break;
                case '2':
                    return redirect()->intended('pemesanan');
                    break;
            }
        }
        return view('auth.login');
    }

    public function cekLogin(AuthRequest $request)
    {
        $credential = $request->only('email', 'password');
        // dd($credential);
        $request->session()->regenerate();
        if (Auth::attempt($credential)) {
            $user = Auth::user();
            switch ($user->level) {
                case '1';
                    return redirect()->intended('/');
                    break;

                case '2';
                    return redirect()->intended('pemesanan');
                    break;
            }
            return redirect()->intended('/');
        }

        return back()->withErrors([
            'nofound' => 'Email atau Password salah!'
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }

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
        ]);

        // Buat user baru
        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => bcrypt($validatedData['password']),
            'level' => $validatedData['level']
        ]);

        // Otentikasi user
        auth()->login($user);

        // Redirect ke halaman login dengan pesan sukses
        return redirect('/login')->with('success', 'Akun Anda telah berhasil dibuat. Silakan login.');
    }
}
