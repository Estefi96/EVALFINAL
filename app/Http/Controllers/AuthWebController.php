<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthWebController extends Controller
{
    // GET /login
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // POST /login
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => ['required','email','regex:/^[A-Za-z]+\.[A-Za-z]+@ventasfix\.cl$/'],
            'password' => 'required|string',
        ]);

        $user = User::where('email', $credentials['email'])->first();

        if (!$user || !Hash::check($credentials['password'], $user->password)) {
            return back()->with('error', 'Credenciales inválidas');
        }

        Auth::login($user);
        return redirect()->route('dashboard');
    }

    // POST /logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login.form');
    }
}