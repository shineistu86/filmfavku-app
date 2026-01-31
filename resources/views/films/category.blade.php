@extends('layouts.app')

@section('title', 'Film Berdasarkan Kategori - FilmFavku')

@section('content')
<div class="container">
    <div class="row mb-4">
        <div class="col-12">
            <h1 class="display-5">Film Genre {{ $category ?? 'Semua Kategori' }}</h1>
            <p class="lead">{{ count($films ?? []) }} film ditemukan</p>
        </div>
    </div>

    <div class="row">
        @if(isset($films) && count($films) > 0)
            @foreach($films as $film)
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
                    <i class="fas fa-info-circle"></i> Maaf, tidak ada film yang ditemukan dalam kategori "{{ $category ?? '' }}"
                </div>
            </div>
        @endif
    </div>
</div>
@endsection