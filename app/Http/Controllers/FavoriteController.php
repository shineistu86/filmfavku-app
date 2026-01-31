<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    /**
     * Menampilkan daftar film favorit
     */
    public function index()
    {
        // Di sini nanti akan ditampilkan daftar film favorit dari database
        return view('favorites.index');
    }

    /**
     * Menambahkan film ke daftar favorit
     */
    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'film_id' => 'required|string',
            'title' => 'required|string|max:255',
            'year' => 'nullable|integer',
            'rating' => 'nullable|numeric|min:1|max:10',
            'notes' => 'nullable|string'
        ]);

        // Di sini nanti akan disimpan ke database
        // $favorite = Favorite::create($validated);

        return redirect()->route('favorites.index')->with('success', 'Film berhasil ditambahkan ke favorit');
    }

    /**
     * Menghapus film dari daftar favorit
     */
    public function destroy($id)
    {
        // Di sini nanti akan menghapus dari database
        // $favorite = Favorite::findOrFail($id);
        // $favorite->delete();

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

        // Di sini nanti akan memperbarui data di database
        // $favorite = Favorite::findOrFail($id);
        // $favorite->update($validated);

        return redirect()->route('favorites.index')->with('success', 'Data favorit berhasil diperbarui');
    }

    /**
     * Menampilkan form edit film favorit
     */
    public function edit($id)
    {
        // Di sini nanti akan mengambil data dari database
        // $favorite = Favorite::findOrFail($id);

        return view('favorites.edit');
    }
}