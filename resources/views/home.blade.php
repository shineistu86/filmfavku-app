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
                @if(isset($films) && !empty($films))
                    @foreach($films['results'] as $film)
                    <div class="col-md-3 col-sm-6 mb-4">
                        <div class="card h-100">
                            <img src="{{ $film['poster'] ?? 'https://placehold.co/300x450/eee/aaa?text=No+Image' }}"
                                 class="card-img-top"
                                 alt="{{ $film['title'] ?? 'No Title' }}"
                                 style="height: 300px; object-fit: cover;">
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title">{{ Str::limit($film['title'] ?? 'Tidak ada judul', 30) }}</h5>
                                <p class="card-text">
                                    <small class="text-muted">{{ $film['year'] ?? 'Tahun tidak diketahui' }}</small>
                                </p>
                                <div class="mt-auto">
                                    <a href="{{ route('film.show', ['id' => $film['id'] ?? 1]) }}" class="btn btn-primary btn-sm w-100">
                                        <i class="fas fa-eye"></i> Detail
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                @else
                    <div class="col-12">
                        <div class="alert alert-info text-center" role="alert">
                            <i class="fas fa-info-circle"></i> Belum ada data film terbaru yang tersedia
                        </div>
                    </div>
                @endif
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