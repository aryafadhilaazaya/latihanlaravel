<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function index()
    {
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

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:users,name',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|string|min:6',
        ], [
            'name.required' => 'Nama wajib diisi.',
            'name.unique' => 'Nama sudah digunakan.',
            'email.required' => 'Email wajib diisi.',
            'email.unique' => 'Email sudah digunakan.',
            'email.email' => 'Format email tidak valid.',
            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password minimal 6 digit.',
        ]);
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
        $user = DB::table('users')->where('id', $id)->first();
        if (!$user) {
            return redirect('/users')->with('error', 'Data User tidak ditemukan.');
        }
        $request->validate([
            'name' => 'required|string|max:255|unique:users,name,' . $id,
            'email' => 'required|email|max:255|unique:users,email,' . $id,
            'password' => 'nullable|string|min:6',
            'current_password' => 'required',
        ], [
            'name.required' => 'Nama wajib diisi.',
            'name.unique' => 'Nama sudah digunakan.',
            'email.required' => 'Email wajib diisi.',
            'email.unique' => 'Email sudah digunakan.',
            'email.email' => 'Format email tidak valid.',
            'password.min' => 'Password minimal 6 digit.',
            'current_password.required' => 'Password saat ini wajib diisi!',
        ]);
        if (!Hash::check($request->current_password, $user->password)) {
            return redirect()->back()->with('error', 'Password saat ini salah!');
        }
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'email_verified_at' => now(),
            'updated_at' => now(),
        ];
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
