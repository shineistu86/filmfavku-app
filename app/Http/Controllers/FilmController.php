<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\FilmapikApiService;

class FilmController extends Controller
{
    protected $filmapikApi;

    public function __construct(FilmapikApiService $filmapikApi)
    {
        $this->filmapikApi = $filmapikApi;
    }

    /**
     * Menampilkan daftar film terbaru
     */
    public function latest()
    {
        $films = $this->filmapikApi->getLatestFilms();

        if (!$films) {
            return redirect()->back()->withErrors(['error' => 'Gagal mengambil data film']);
        }

        return view('films.latest', compact('films'));
    }

    /**
     * Mencari film berdasarkan judul
     */
    public function search(Request $request)
    {
        $query = $request->input('q');

        if (!$query) {
            return redirect()->back();
        }

        $films = $this->filmapikApi->searchFilms($query);

        if (!$films) {
            return redirect()->back()->withErrors(['error' => 'Gagal mencari film']);
        }

        return view('films.search', compact('films', 'query'));
    }

    /**
     * Menampilkan detail film
     */
    public function show($id)
    {
        $film = $this->filmapikApi->getFilmDetail($id);

        if (!$film) {
            return redirect()->route('home')->withErrors(['error' => 'Gagal mengambil detail film']);
        }

        return view('films.detail', compact('film'));
    }

    /**
     * Menampilkan film berdasarkan negara
     */
    public function byCountry(Request $request)
    {
        $country = $request->input('search');

        if (!$country) {
            return redirect()->back();
        }

        $films = $this->filmapikApi->getFilmsByCountry($country);

        if (!$films) {
            return redirect()->back()->withErrors(['error' => 'Gagal mengambil film berdasarkan negara']);
        }

        return view('films.country', compact('films', 'country'));
    }

    /**
     * Menampilkan film berdasarkan kategori
     */
    public function byCategory(Request $request)
    {
        $category = $request->input('search');

        if (!$category) {
            return redirect()->back();
        }

        $films = $this->filmapikApi->getFilmsByCategory($category);

        if (!$films) {
            return redirect()->back()->withErrors(['error' => 'Gagal mengambil film berdasarkan kategori']);
        }

        return view('films.category', compact('films', 'category'));
    }
}