<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function tampil()
    {
        $this->middleware('auth');

        return view('profile.index');
    }

    public function update(Request $request)
    {
        // Validate the form data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'ponsel' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
        ]);

        $user = Auth::user();

        // Update user attributes
        $user->name = $validatedData['name'];
        $user->alamat = $validatedData['alamat'];
        $user->ponsel = $validatedData['ponsel'];
        $user->email = $validatedData['email'];

        try {
            $user->save();
        } catch (\Exception $e) {
            // Jika terjadi kesalahan saat menyimpan, dd pesan kesalahan
            dd($e->getMessage());
        }

        return redirect()->back()->with('success', 'Profile updated successfully');
    }
}
