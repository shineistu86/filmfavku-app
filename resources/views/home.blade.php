@extends('layouts.app')

@section('title', 'Beranda - FilmFavku')

@section('content')
<div class="container">
    <div class="row mb-5">
        <div class="col-12 text-center">
            <h1 class="display-4">Selamat Datang di <strong>FilmFavku</strong></h1>
            <p class="lead">Aplikasi manajemen film favoritmu</p>
            <hr>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-md-8 mx-auto">
            <form action="{{ route('film.search') }}" method="GET" class="mb-4">
                <div class="input-group input-group-lg">
                    <input type="text" name="q" class="form-control" placeholder="Cari film favoritmu..." required>
                    <button class="btn btn-primary" type="submit">
                        <i class="fas fa-search"></i> Cari
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <h2 class="mb-4">Film Terbaru</h2>
            <div class="row" id="latestFilms">
                <!-- Film akan dimuat di sini melalui AJAX atau langsung dari controller -->
                <div class="col-md-12 text-center">
                    <p>Daftar film terbaru akan ditampilkan di sini...</p>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-5">
        <div class="col-md-12">
            <h2 class="mb-4">Kategori Populer</h2>
            <div class="row">
                <div class="col-md-3 col-sm-6 mb-3">
                    <a href="{{ route('film.category', ['search' => 'action']) }}" class="btn btn-outline-primary w-100">
                        <i class="fas fa-bolt"></i> Action
                    </a>
                </div>
                <div class="col-md-3 col-sm-6 mb-3">
                    <a href="{{ route('film.category', ['search' => 'comedy']) }}" class="btn btn-outline-success w-100">
                        <i class="fas fa-laugh"></i> Komedi
                    </a>
                </div>
                <div class="col-md-3 col-sm-6 mb-3">
                    <a href="{{ route('film.category', ['search' => 'drama']) }}" class="btn btn-outline-info w-100">
                        <i class="fas fa-theater-masks"></i> Drama
                    </a>
                </div>
                <div class="col-md-3 col-sm-6 mb-3">
                    <a href="{{ route('film.category', ['search' => 'horror']) }}" class="btn btn-outline-danger w-100">
                        <i class="fas fa-mask"></i> Horror
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection