@extends('layouts.app')

@section('title', 'Detail Film - FilmFavku')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                @if(isset($film) && $film)
                    <img src="{{ $film['poster'] ?? 'https://placehold.co/300x450/eee/aaa?text=No+Image' }}" class="card-img-top" alt="{{ $film['title'] ?? 'No Image' }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $film['title'] ?? 'Tidak ada judul' }}</h5>
                        <p class="card-text">
                            <strong>Tahun:</strong> {{ $film['year'] ?? 'Tidak diketahui' }}<br>
                            <strong>Durasi:</strong> {{ $film['runtime'] ?? 'Tidak diketahui' }}<br>
                            <strong>Genre:</strong> {{ $film['genre'] ?? 'Tidak diketahui' }}<br>
                            <strong>Rating:</strong> {{ $film['imdb_rating'] ?? 'Tidak diketahui' }}/10
                        </p>
                        <div class="d-grid gap-2">
                            <a href="{{ route('favorites.store') }}?film_id={{ $film['id'] }}&title={{ urlencode($film['title']) }}&year={{ $film['year'] }}&poster_url={{ urlencode($film['poster'] ?? '') }}" class="btn btn-warning">
                                <i class="fas fa-star"></i> Tambah ke Favorit
                            </a>
                            <a href="{{ route('favorites.index') }}" class="btn btn-outline-primary">
                                <i class="fas fa-list"></i> Lihat Favorit
                            </a>
                        </div>
                    </div>
                @else
                    <div class="card-body">
                        <h5 class="card-title">Film Tidak Ditemukan</h5>
                        <p class="card-text">Maaf, film yang Anda cari tidak ditemukan.</p>
                        <a href="{{ route('home') }}" class="btn btn-primary">
                            <i class="fas fa-arrow-left"></i> Kembali ke Beranda
                        </a>
                    </div>
                @endif
            </div>
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <h2>Sinopsis</h2>
                    <p class="lead">{{ $film['plot'] ?? 'Sinopsis tidak tersedia.' }}</p>

                    <h3>Pemain</h3>
                    <p>{{ $film['actors'] ?? 'Informasi pemain tidak tersedia.' }}</p>

                    <h3>Director</h3>
                    <p>{{ $film['director'] ?? 'Informasi director tidak tersedia.' }}</p>

                    @if(isset($film['trailer']) && $film['trailer'])
                    <h3>Trailer</h3>
                    <div class="ratio ratio-16x9">
                        <iframe src="{{ $film['trailer'] }}" title="Trailer Film" allowfullscreen></iframe>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection