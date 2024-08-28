<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class RegisteredUserController extends Controller
{
    public function create()
    {
        return view('auth.register');
    }

    public function store(Request $request)
{
    // Validate the incoming request
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'username' => 'required|string|max:255|unique:users', // Validate username
        'password' => 'required|string|min:8|confirmed',
    ]);

    // Create the new user and hash the password
    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'username' => $request->username, // Store username
        'password' => Hash::make($request->password),
    ]);

    // Log the user in
    Auth::login($user);

    // Redirect to home page
    return redirect()->intended('/home');
}

}
