<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Favorite;
use App\Services\FilmapikApiService;

class FavoriteController extends Controller
{
    protected $filmapikApi;

    public function __construct(FilmapikApiService $filmapikApi)
    {
        $this->filmapikApi = $filmapikApi;
    }

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
            'poster_url' => 'nullable|url',
            'imdb_id' => 'nullable|string'
        ]);

        // Simpan ke database
        $favorite = Favorite::create($validated);

        return redirect()->route('favorites.index')->with('success', 'Film berhasil ditambahkan ke favorit');
    }

    /**
     * Menambahkan film ke daftar favorit dari data API
     */
    public function storeFromApi(Request $request)
    {
        // Ambil data dari API berdasarkan ID film
        $filmData = $this->filmapikApi->getFilmDetail($request->film_id);

        if (!$filmData) {
            return redirect()->back()->withErrors(['error' => 'Gagal mengambil data film dari API']);
        }

        // Validasi dan parsing data dari API
        $validated = $request->validate([
            'film_id' => 'required|string|unique:favorites,film_id',
            'rating' => 'nullable|numeric|min:1|max:10',
            'notes' => 'nullable|string'
        ]);

        // Siapkan data untuk disimpan
        $dataToSave = [
            'film_id' => $filmData['id'] ?? $request->film_id,
            'title' => $filmData['title'] ?? 'Tidak diketahui',
            'year' => $filmData['year'] ?? null,
            'rating' => $validated['rating'] ?? null,
            'notes' => $validated['notes'] ?? null,
            'poster_url' => $filmData['poster'] ?? null,
            'imdb_id' => $filmData['imdb_id'] ?? null
        ];

        // Simpan ke database
        $favorite = Favorite::create($dataToSave);

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