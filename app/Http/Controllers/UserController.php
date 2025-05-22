<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function index() {
        return view('users.index', ['users' => DB::table('users')->get(),]);
    }
    
    public function show($id)
    {
        // Mengambil Data User berdasarkan ID
        $user = DB::table('users')->find($id);

        if (!$user) {
            return redirect('/users')->with('error', 'Data User tidak ditemukan.');
        }

        return view('users.show', compact('user'));
    }

    public function create() {
        return view('users.create');
    }
    
    public function store(Request $request)
    {
        // Validasi format email
        if (!filter_var($request->email, FILTER_VALIDATE_EMAIL)) {
            return redirect('/users/create')->with('error', 'Format email tidak valid!');
        }
        // Cek apakah email sudah ada
        $emailExists = DB::table('users')->where('email', $request->email)->exists();
        // Cek apakah nama sudah ada
        $nameExists = DB::table('users')->where('name', $request->name)->exists();
        if ($emailExists && $nameExists) {
            return redirect('/users/create')->with('error', 'Nama dan Email sudah terdaftar!');
        } elseif ($emailExists) {
            return redirect('/users/create')->with('error', 'Email sudah terdaftar!');
        } elseif ($nameExists) {
            return redirect('/users/create')->with('error', 'Nama sudah terdaftar!');
        }
        // Menyimpan Data User ke database
        DB::table('users')->insert([
            'name' => $request->name,
            'email' => $request->email,
            'email_verified_at' => now(),
            'password' => Hash::make($request->password),
            'remember_token' => Str::random(10),
            'created_at' => now(),
            'updated_at' => null,
        ]);

        return redirect('/users')->with('success', 'Data User berhasil disimpan!');
    }

    public function edit($id)
    {
        // Mengambil Data User berdasarkan ID untuk diedit
        $user = DB::table('users')->find($id);

        if (!$user) {
            return redirect('/users')->with('error', 'Data User tidak ditemukan.');
        }

        return view('users.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        // Ambil data user lama
        $user = DB::table('users')->where('id', $id)->first();
        if (!$user) {
            return redirect('/users')->with('error', 'Data User tidak ditemukan.');
        }

        // Validasi password saat ini
        if (!$request->filled('current_password')) {
            return redirect()->back()->with('error', 'Password saat ini wajib diisi!');
        }
        if (!Hash::check($request->current_password, $user->password)) {
            return redirect()->back()->with('error', 'Password saat ini salah!');
        }

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'email_verified_at' => now(),
            'updated_at' => now(),
        ];
        // Jika password diisi, update password. Jika kosong, biarkan password lama.
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $updated = DB::table('users')
            ->where('id', $id)
            ->update($data);

        if (!$updated) {
            return redirect('/users')->with('error', 'Gagal memperbarui Data User.');
        }

        return redirect('/users')->with('success', 'Data User berhasil diperbarui!');
    }

    public function destroy($id)
    {
        // Menghapus Data User berdasarkan ID
        $deleted = DB::table('users')->where('id', $id)->delete();

        if (!$deleted) {
            return redirect('/users')->with('error', 'Gagal menghapus Data User.');
        }

        return redirect('/users')->with('success', 'Data User berhasil dihapus!');
    }
}
