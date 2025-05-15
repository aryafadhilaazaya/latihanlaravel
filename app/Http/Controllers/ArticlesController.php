<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ArticlesController extends Controller
{
    public function index()
    {
        // Mengambil semua artikel dari database
        $articles = DB::table('articles')->get();
        return view('articles.index', compact('articles'));
    }

    public function show($id)
    {
        // Mengambil artikel berdasarkan ID
        $article = DB::table('articles')->find($id);

        if (!$article) {
            return redirect('/articles')->with('error', 'Artikel tidak ditemukan.');
        }

        return view('articles.show', compact('article'));
    }

    public function create()
    {
        // Menampilkan form untuk membuat artikel baru
        return view('articles.create');
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
        ]);

        // Menyimpan artikel ke database
        DB::table('articles')->insert([
            'title' => $request->title,
            'body' => $request->body,
            'created_at' => now(),
            'updated_at' => null,
        ]);

        return redirect('/articles')->with('success', 'Artikel berhasil disimpan!');
    }

    public function edit($id)
    {
        // Mengambil artikel berdasarkan ID untuk diedit
        $article = DB::table('articles')->find($id);

        if (!$article) {
            return redirect('/articles')->with('error', 'Artikel tidak ditemukan.');
        }

        return view('articles.edit', compact('article'));
    }

    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
        ]);

        // Memperbarui artikel berdasarkan ID
        $updated = DB::table('articles')
            ->where('id', $id)
            ->update([
                'title' => $request->title,
                'body' => $request->body,
                'updated_at' => now(),
            ]);

        if (!$updated) {
            return redirect('/articles')->with('error', 'Gagal memperbarui artikel.');
        }

        return redirect('/articles')->with('success', 'Artikel berhasil diperbarui!');
    }

    public function destroy($id)
    {
        // Menghapus artikel berdasarkan ID
        $deleted = DB::table('articles')->where('id', $id)->delete();

        if (!$deleted) {
            return redirect('/articles')->with('error', 'Gagal menghapus artikel.');
        }

        return redirect('/articles')->with('success', 'Artikel berhasil dihapus!');
    }
}