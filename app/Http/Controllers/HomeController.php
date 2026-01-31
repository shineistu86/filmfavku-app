<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\FilmapikApiService;

class HomeController extends Controller
{
    protected $filmapikApi;

    public function __construct(FilmapikApiService $filmapikApi)
    {
        $this->filmapikApi = $filmapikApi;
    }

    /**
     * Menampilkan halaman utama aplikasi FilmFavku
     */
    public function index()
    {
        // Ambil daftar film terbaru dari API
        $films = $this->filmapikApi->getLatestFilms();

        return view('home', compact('films'));
    }
}