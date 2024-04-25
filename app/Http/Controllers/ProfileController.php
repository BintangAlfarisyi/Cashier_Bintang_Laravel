<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

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
}
