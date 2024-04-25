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
        $request->validate([
            'name' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'ponsel' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
        ]);

        $user = Auth::user();

        // Update user attributes
        $user->name = $request->input('name');
        $user->alamat = $request->input('alamat');
        $user->ponsel = $request->input('ponsel');
        $user->email = $request->input('email');

        return redirect()->back()->with('success', 'Profile updated successfully');
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|string|min:8|confirmed',
        ]);

        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            return redirect()->back()->withErrors(['current_password' => 'Password tidak sesuai.']);
        }

        $user->password = Hash::make($request->new_password);
        $user->save();

        return redirect()->back()->with('success', 'Password Berhasil diubah!');
    }
}
