<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Favorite;

class FavoriteController extends Controller
{
    /**
     * Menampilkan daftar film favorit
     */
    public function index()
    {
        $favorites = Favorite::orderBy('created_at', 'desc')->get();
        return view('favorites.index', compact('favorites'));
    }

    /**
     * Menambahkan film ke daftar favorit
     */
    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'film_id' => 'required|string|unique:favorites,film_id',
            'title' => 'required|string|max:255',
            'year' => 'nullable|integer',
            'rating' => 'nullable|numeric|min:1|max:10',
            'notes' => 'nullable|string',
            'poster_url' => 'nullable|url'
        ]);

        // Simpan ke database
        $favorite = Favorite::create($validated);

        return redirect()->route('favorites.index')->with('success', 'Film berhasil ditambahkan ke favorit');
    }

    /**
     * Menghapus film dari daftar favorit
     */
    public function destroy($id)
    {
        $favorite = Favorite::findOrFail($id);
        $favorite->delete();

        return redirect()->route('favorites.index')->with('success', 'Film berhasil dihapus dari favorit');
    }

    /**
     * Memperbarui data film favorit
     */
    public function update(Request $request, $id)
    {
        // Validasi input
        $validated = $request->validate([
            'rating' => 'nullable|numeric|min:1|max:10',
            'notes' => 'nullable|string'
        ]);

        $favorite = Favorite::findOrFail($id);
        $favorite->update($validated);

        return redirect()->route('favorites.index')->with('success', 'Data favorit berhasil diperbarui');
    }

    /**
     * Menampilkan form edit film favorit
     */
    public function edit($id)
    {
        $favorite = Favorite::findOrFail($id);
        return view('favorites.edit', compact('favorite'));
    }
}