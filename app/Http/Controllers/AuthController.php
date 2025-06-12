<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        if ($request->isMethod('get')) {
            return view('login');
        }

        $request->validate([
            'name' => 'required',
            'password' => 'required',
        ]);

        $user = DB::table('users')->where('name', $request->name)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            Auth::loginUsingId($user->id);
            session()->flash('success', 'Login berhasil! Selamat datang, ' . $user->name);
            return redirect('home');
        }

        session()->flash('error', 'Nama atau password salah.');
        return back();
    }

    public function home()
    {
        return view('home');
    }

    public function galeri()
    {
        return view('galeri');
    }

    public function tentang()
    {
        return view('tentang');
    }

    public function showRegisterForm()
    {
        return view('register');
    }

    public function register(Request $request)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255|unique:users,name',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
        ], [
            'name.required' => 'Nama wajib diisi.',
            'name.unique' => 'Nama sudah digunakan.',
            'email.required' => 'Email wajib diisi.',
            'email.unique' => 'Email sudah digunakan.',
            'email.email' => 'Format email tidak valid.',
            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password minimal 6 digit.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
        ]);

        // Simpan data user ke database
        DB::table('users')->insert([
            'name' => $request->name,
            'email' => $request->email,
            'email_verified_at' => now(),
            'password' => Hash::make($request->password),
            'remember_token' => Str::random(10),
            'created_at' => now(),
            'updated_at' => null,
        ]);

        // Redirect dengan pesan sukses
        return redirect('/')->with('success', 'Registrasi berhasil! Silakan login.');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate(); // Hapus sesi pengguna
        $request->session()->regenerateToken(); // Regenerasi token CSRF

        return redirect('/')->with('success', 'Anda telah berhasil logout.');
    }
}
