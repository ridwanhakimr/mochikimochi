<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class AuthController extends Controller
{
    public function formLogin()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        // 1. Validasi input
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        // 2. Ambil kredensial dari request (gunakan username)
        $credentials = $request->only('username', 'password');

        // 3. Coba lakukan login
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate(); // Regenerasi session untuk keamanan
            $user = Auth::user();

            // 4. Cek apakah user adalah admin
            if ($user->is_admin) {
                return redirect()->intended(route('admin.dashboard'));
            } else {
                // Jika bukan admin, logout dan beri pesan error
                Auth::logout();
                return back()->with('error', 'Anda tidak memiliki hak akses admin.');
            }
        }

        // 5. Jika login gagal
        return back()->with('error', 'Username atau password salah.');
    }

    public function logout(Request $request)
    {
        Auth::logout(); // Proses logout

        $request->session()->invalidate(); // Matikan sesi yang ada

        $request->session()->regenerateToken(); // Buat token baru

        return redirect('/login'); // Arahkan ke halaman login
    }
}