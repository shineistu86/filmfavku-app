<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class FilmapikApiService
{
    protected $baseUrl;
    protected $timeout;

    public function __construct()
    {
        $this->baseUrl = config('filmapik.base_url');
        $this->timeout = config('filmapik.timeout', 30);
    }

    /**
     * Mendapatkan daftar film terbaru
     */
    public function getLatestFilms()
    {
        try {
            $response = Http::timeout($this->timeout)->get($this->baseUrl . '/latest');
            
            if ($response->successful()) {
                return $response->json();
            }
            
            Log::error('Gagal mengambil data film terbaru', [
                'status' => $response->status(),
                'body' => $response->body()
            ]);
            
            return null;
        } catch (\Exception $e) {
            Log::error('Error saat mengambil data film terbaru', [
                'error' => $e->getMessage()
            ]);
            
            return null;
        }
    }

    /**
     * Mencari film berdasarkan judul
     */
    public function searchFilms($query)
    {
        try {
            $response = Http::timeout($this->timeout)->get($this->baseUrl . '/search', [
                'q' => $query
            ]);
            
            if ($response->successful()) {
                return $response->json();
            }
            
            Log::error('Gagal mencari film', [
                'query' => $query,
                'status' => $response->status(),
                'body' => $response->body()
            ]);
            
            return null;
        } catch (\Exception $e) {
            Log::error('Error saat mencari film', [
                'query' => $query,
                'error' => $e->getMessage()
            ]);
            
            return null;
        }
    }

    /**
     * Mendapatkan detail film berdasarkan ID
     */
    public function getFilmDetail($id)
    {
        try {
            $response = Http::timeout($this->timeout)->get($this->baseUrl . '/detail/' . $id);
            
            if ($response->successful()) {
                return $response->json();
            }
            
            Log::error('Gagal mengambil detail film', [
                'id' => $id,
                'status' => $response->status(),
                'body' => $response->body()
            ]);
            
            return null;
        } catch (\Exception $e) {
            Log::error('Error saat mengambil detail film', [
                'id' => $id,
                'error' => $e->getMessage()
            ]);
            
            return null;
        }
    }

    /**
     * Mendapatkan film berdasarkan negara
     */
    public function getFilmsByCountry($country)
    {
        try {
            $response = Http::timeout($this->timeout)->get($this->baseUrl . '/country', [
                'search' => $country
            ]);
            
            if ($response->successful()) {
                return $response->json();
            }
            
            Log::error('Gagal mengambil film berdasarkan negara', [
                'country' => $country,
                'status' => $response->status(),
                'body' => $response->body()
            ]);
            
            return null;
        } catch (\Exception $e) {
            Log::error('Error saat mengambil film berdasarkan negara', [
                'country' => $country,
                'error' => $e->getMessage()
            ]);
            
            return null;
        }
    }

    /**
     * Mendapatkan film berdasarkan kategori
     */
    public function getFilmsByCategory($category)
    {
        try {
            $response = Http::timeout($this->timeout)->get($this->baseUrl . '/category', [
                'search' => $category
            ]);
            
            if ($response->successful()) {
                return $response->json();
            }
            
            Log::error('Gagal mengambil film berdasarkan kategori', [
                'category' => $category,
                'status' => $response->status(),
                'body' => $response->body()
            ]);
            
            return null;
        } catch (\Exception $e) {
            Log::error('Error saat mengambil film berdasarkan kategori', [
                'category' => $category,
                'error' => $e->getMessage()
            ]);
            
            return null;
        }
    }
}