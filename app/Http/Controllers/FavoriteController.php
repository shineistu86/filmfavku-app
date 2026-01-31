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

        // Parsing data dari API dengan validasi
        $parsedData = $this->parseApiData($filmData, $validated);

        // Simpan ke database
        $favorite = Favorite::create($parsedData);

        return redirect()->route('favorites.index')->with('success', 'Film berhasil ditambahkan ke favorit');
    }

    /**
     * Parsing data dari API
     */
    private function parseApiData($apiData, $validatedInput)
    {
        return [
            'film_id' => $apiData['id'] ?? null,
            'title' => $apiData['title'] ?? 'Tidak diketahui',
            'year' => $this->extractYear($apiData['year'] ?? $apiData['released'] ?? null),
            'rating' => $validatedInput['rating'] ?? $this->convertRating($apiData['imdb_rating'] ?? null),
            'notes' => $validatedInput['notes'] ?? null,
            'poster_url' => $apiData['poster'] ?? $apiData['image'] ?? null,
            'imdb_id' => $apiData['imdb_id'] ?? $apiData['imdbID'] ?? null
        ];
    }

    /**
     * Ekstrak tahun dari berbagai format
     */
    private function extractYear($yearData)
    {
        if (is_numeric($yearData)) {
            return (int)$yearData;
        }

        if (is_string($yearData)) {
            // Jika tahun dalam format "YYYY-MM-DD" atau "YYYY"
            preg_match('/^(\d{4})/', $yearData, $matches);
            if (isset($matches[1])) {
                return (int)$matches[1];
            }
        }

        return null;
    }

    /**
     * Konversi rating dari format API ke format yang diinginkan
     */
    private function convertRating($rating)
    {
        if ($rating === null) {
            return null;
        }

        // Jika rating dalam format "8.5/10" atau hanya "8.5"
        if (is_string($rating)) {
            $rating = trim($rating);
            if (strpos($rating, '/') !== false) {
                // Format seperti "8.5/10"
                $parts = explode('/', $rating);
                return floatval($parts[0]);
            }
            return floatval($rating);
        }

        return floatval($rating);
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