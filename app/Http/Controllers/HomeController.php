<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Menampilkan halaman utama aplikasi FilmFavku
     */
    public function index()
    {
        // Di sini nanti akan ditampilkan daftar film terbaru dari API
        return view('home');
    }
}