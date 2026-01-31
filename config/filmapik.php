<?php

return [
    /*
    |--------------------------------------------------------------------------
    | API Configuration for FilmFavku
    |--------------------------------------------------------------------------
    |
    | Pengaturan untuk API eksternal yang digunakan dalam aplikasi
    | untuk mengambil data film dari api-filmapik
    |
    */

    'filmapik' => [
        'base_url' => env('FILMAPIK_API_URL', 'https://api-filmapik.vercel.app/api'),
        'timeout' => env('FILMAPIK_TIMEOUT', 30),
    ],

];