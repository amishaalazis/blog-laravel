<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class AuthController extends Controller
{
    // REGISTER

    // menqampilkan halaman register
    public function showRegister()
    {
        return view('auth.register');
    }

    // menangani proses register
    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'confirmed', Password::min(8)],
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            // hash -> harus digunakan untuk password karena berguna untuk enskrip data password
            'password' => Hash::make($validated['password']), 
            'role' => 'user',
        ]);

        Auth::login($user);

        $request->session()->regenerate();

        return redirect()->route('dashboard');
    }

    // LOGIN

    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);
        // pengkondisian
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended(
                route('dashboard')
            );
        }

        return back()
            ->withErrors([
                'email' => 'Email atau password salah.',
            ])
            ->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}