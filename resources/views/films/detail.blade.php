@extends('layouts.app')

@section('title', 'Detail Film - FilmFavku')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                @if(isset($film) && $film)
                    <img src="{{ $film['poster'] ?? 'https://placehold.co/300x450/eee/aaa?text=No+Image' }}" class="card-img-top" alt="{{ $film['title'] ?? 'No Image' }}" onerror="this.onerror=null; this.src='https://placehold.co/300x450/eee/aaa?text=No+Image';">
                    <div class="card-body">
                        <h5 class="card-title">{{ $film['title'] ?? 'Tidak ada judul' }}</h5>
                        <p class="card-text">
                            <strong>Tahun:</strong> {{ $film['year'] ?? 'Tidak diketahui' }}<br>
                            <strong>Durasi:</strong> {{ $film['runtime'] ?? 'Tidak diketahui' }}<br>
                            <strong>Genre:</strong> {{ $film['genre'] ?? 'Tidak diketahui' }}<br>
                            <strong>Rating:</strong>
                            @if($film['imdb_rating'])
                                {{ $film['imdb_rating'] }}/10
                                <span class="text-warning">
                                    @for($i = 1; $i <= 10; $i++)
                                        @if($i <= $film['imdb_rating'])
                                            <i class="fas fa-star"></i>
                                        @else
                                            <i class="far fa-star"></i>
                                        @endif
                                    @endfor
                                </span>
                            @else
                                Tidak diketahui
                            @endif
                        </p>
                        <div class="d-grid gap-2">
                            <form method="POST" action="{{ route('favorites.store') }}">
                                @csrf
                                <input type="hidden" name="film_id" value="{{ $film['id'] }}">
                                <input type="hidden" name="title" value="{{ $film['title'] }}">
                                <input type="hidden" name="year" value="{{ $film['year'] }}">
                                <input type="hidden" name="poster_url" value="{{ $film['poster'] ?? '' }}">
                                <input type="hidden" name="imdb_id" value="{{ $film['imdb_id'] ?? '' }}">
                                <button type="submit" class="btn btn-warning w-100">
                                    <i class="fas fa-star"></i> Tambah ke Favorit
                                </button>
                            </form>
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

                    <div class="row">
                        <div class="col-md-6">
                            <h3>Pemain</h3>
                            <p>{{ $film['actors'] ?? 'Informasi pemain tidak tersedia.' }}</p>

                            <h3>Director</h3>
                            <p>{{ $film['director'] ?? 'Informasi director tidak tersedia.' }}</p>

                            <h3>Writer</h3>
                            <p>{{ $film['writer'] ?? 'Informasi penulis tidak tersedia.' }}</p>
                        </div>
                        <div class="col-md-6">
                            <h3>Info Tambahan</h3>
                            <p>
                                <strong>Negara:</strong> {{ $film['country'] ?? 'Tidak diketahui' }}<br>
                                <strong>Bahasa:</strong> {{ $film['language'] ?? 'Tidak diketahui' }}<br>
                                <strong>Rilis:</strong> {{ $film['released'] ?? 'Tidak diketahui' }}<br>
                                <strong>Box Office:</strong> {{ $film['box_office'] ?? 'Tidak diketahui' }}
                            </p>
                        </div>
                    </div>

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