@extends('layouts.app')

@section('title', 'Film Favorit - FilmFavku')

@section('content')
<div class="container">
    <div class="row mb-4">
        <div class="col-12">
            <h1 class="display-5">Film Favoritku</h1>
            <p class="lead">Daftar film favorit yang telah kamu simpan</p>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="alert alert-info" role="alert">
                <i class="fas fa-info-circle"></i> Kamu belum memiliki film favorit. Mulai tambahkan film favoritmu sekarang!
            </div>
            
            <!-- Contoh daftar film favorit (akan dinamis dari database nanti) -->
            <div class="row" id="favoriteFilms">
                <!-- Film favorit akan ditampilkan di sini -->
            </div>
        </div>
    </div>
</div>
@endsection