@extends('layouts.app')

@section('title', 'Detail Film - FilmFavku')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <img src="https://placehold.co/300x450/eee/aaa?text=Poster+Film" class="card-img-top" alt="Poster Film">
                <div class="card-body">
                    <h5 class="card-title">Judul Film Contoh</h5>
                    <p class="card-text">
                        <strong>Tahun:</strong> 2023<br>
                        <strong>Durasi:</strong> 120 menit<br>
                        <strong>Genre:</strong> Action, Adventure<br>
                        <strong>Rating:</strong> 8.5/10
                    </p>
                    <div class="d-grid gap-2">
                        <button class="btn btn-warning" type="button">
                            <i class="fas fa-star"></i> Tambah ke Favorit
                        </button>
                        <a href="{{ route('favorites.index') }}" class="btn btn-outline-primary">
                            <i class="fas fa-list"></i> Lihat Favorit
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <h2>Sinopsis</h2>
                    <p class="lead">Ini adalah contoh sinopsis film. Dalam implementasi sebenarnya, data ini akan diambil dari API filmapik.</p>
                    
                    <h3>Pemain</h3>
                    <p>Nama Pemain 1, Nama Pemain 2, Nama Pemain 3</p>
                    
                    <h3>Director</h3>
                    <p>Nama Director</p>
                    
                    <h3>Trailer</h3>
                    <div class="ratio ratio-16x9">
                        <iframe src="https://www.youtube.com/embed/placeholder" title="Trailer Film" allowfullscreen></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection