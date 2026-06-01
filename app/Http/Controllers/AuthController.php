<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Menampilkan halaman form login
    public function showLogin()
    {
        return view('auth.login');
    }

    // Memproses data yang diinput saat tombol "Masuk" diklik
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required'],
            'password' => ['required'],
        ]);

        // Cek kecocokan di database
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // Kalau sukses, lempar ke halaman dashboard
            return redirect()->route('dashboard');
        }

        // Kalau gagal, balik ke halaman login bawa pesan error
        return back()->withErrors([
            'username' => 'Username atau password salah.',
        ])->onlyInput('username');
    }

    // Memproses saat tombol "Logout" diklik
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        // Lempar balik ke halaman login awal
        return redirect('/');
    }
}