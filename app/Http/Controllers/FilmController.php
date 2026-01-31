<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class FilmController extends Controller
{
    private $apiUrl;

    public function __construct()
    {
        $this->apiUrl = config('filmapik.base_url');
    }

    /**
     * Menampilkan daftar film terbaru
     */
    public function latest()
    {
        try {
            $response = Http::timeout(config('filmapik.timeout'))->get($this->apiUrl . '/latest');
            $films = $response->json();

            return view('films.latest', compact('films'));
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Gagal mengambil data film: ' . $e->getMessage()]);
        }
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

        try {
            $response = Http::timeout(config('filmapik.timeout'))->get($this->apiUrl . '/search', [
                'q' => $query
            ]);
            $films = $response->json();

            return view('films.search', compact('films', 'query'));
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Gagal mencari film: ' . $e->getMessage()]);
        }
    }

    /**
     * Menampilkan detail film
     */
    public function show($id)
    {
        try {
            $response = Http::timeout(config('filmapik.timeout'))->get($this->apiUrl . '/detail/' . $id);
            $film = $response->json();

            return view('films.detail', compact('film'));
        } catch (\Exception $e) {
            return redirect()->route('home')->withErrors(['error' => 'Gagal mengambil detail film: ' . $e->getMessage()]);
        }
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

        try {
            $response = Http::timeout(config('filmapik.timeout'))->get($this->apiUrl . '/country', [
                'search' => $country
            ]);
            $films = $response->json();

            return view('films.country', compact('films', 'country'));
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Gagal mengambil film berdasarkan negara: ' . $e->getMessage()]);
        }
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

        try {
            $response = Http::timeout(config('filmapik.timeout'))->get($this->apiUrl . '/category', [
                'search' => $category
            ]);
            $films = $response->json();

            return view('films.category', compact('films', 'category'));
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Gagal mengambil film berdasarkan kategori: ' . $e->getMessage()]);
        }
    }
}