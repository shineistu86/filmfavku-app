<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\FilmController;
use App\Http\Controllers\FavoriteController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route untuk halaman utama
Route::get('/', [HomeController::class, 'index'])->name('home');

// Route untuk pencarian dan detail film
Route::prefix('film')->group(function () {
    Route::get('/search', [FilmController::class, 'search'])->name('film.search');
    Route::get('/latest', [FilmController::class, 'latest'])->name('film.latest');
    Route::get('/detail/{id}', [FilmController::class, 'show'])->name('film.show');
    Route::get('/country', [FilmController::class, 'byCountry'])->name('film.country');
    Route::get('/category', [FilmController::class, 'byCategory'])->name('film.category');
});

// Route untuk film favorit
Route::prefix('favorites')->group(function () {
    Route::get('/', [FavoriteController::class, 'index'])->name('favorites.index');
    Route::post('/', [FavoriteController::class, 'store'])->name('favorites.store');
    Route::delete('/{id}', [FavoriteController::class, 'destroy'])->name('favorites.destroy');
    Route::put('/{id}', [FavoriteController::class, 'update'])->name('favorites.update');
    Route::get('/{id}/edit', [FavoriteController::class, 'edit'])->name('favorites.edit');
});
