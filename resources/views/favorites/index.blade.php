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

    <div class="row mb-4">
        <div class="col-md-12">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <p class="mb-0">
                        <span class="badge bg-primary">{{ $favorites->count() }}</span>
                        film favorit ditemukan
                    </p>
                </div>
                <div>
                    <a href="{{ route('home') }}" class="btn btn-outline-primary">
                        <i class="fas fa-plus"></i> Tambah Film Baru
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            @if($favorites->count() > 0)
                <div class="row" id="favoriteFilms">
                    @foreach($favorites as $favorite)
                    <div class="col-md-3 col-sm-6 mb-4">
                        <div class="card h-100 shadow-sm position-relative">
                            @if($favorite->poster_url)
                                <img src="{{ $favorite->poster_url }}" class="card-img-top" alt="{{ $favorite->title }}" style="height: 300px; object-fit: cover;" onerror="this.onerror=null; this.src='https://placehold.co/300x450/eee/aaa?text=No+Image';">
                            @else
                                <img src="https://placehold.co/300x450/eee/aaa?text=No+Image" class="card-img-top" alt="{{ $favorite->title }}" style="height: 300px; object-fit: cover;">
                            @endif

                            <div class="position-absolute top-0 start-0 m-2">
                                <span class="badge bg-warning text-dark">
                                    @if($favorite->rating)
                                        {{ number_format($favorite->rating, 1) }}/10
                                    @else
                                        -
                                    @endif
                                </span>
                            </div>

                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title text-truncate" title="{{ $favorite->title }}">{{ $favorite->title }}</h5>
                                <p class="card-text">
                                    <small class="text-muted">
                                        <i class="fas fa-calendar-alt"></i> {{ $favorite->year ?: 'N/A' }}
                                    </small>
                                </p>

                                @if($favorite->notes)
                                    <p class="card-text small text-muted fst-italic text-truncate" title="{{ $favorite->notes }}">
                                        "{{ Str::limit($favorite->notes, 50) }}"
                                    </p>
                                @endif

                                <div class="mt-auto">
                                    <div class="d-grid gap-2">
                                        <a href="{{ route('favorites.edit', $favorite->id) }}" class="btn btn-sm btn-outline-warning">
                                            <i class="fas fa-edit"></i> Edit
                                        </a>
                                        <form action="{{ route('favorites.destroy', $favorite->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Yakin ingin menghapus {{ $favorite->title }} dari favorit?')">
                                                <i class="fas fa-trash-alt"></i> Hapus
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                <div class="row">
                    <div class="col-12">
                        <nav aria-label="Navigasi halaman">
                            <ul class="pagination justify-content-center">
                                {{-- Pagination akan ditambahkan jika jumlah data banyak --}}
                                <li class="page-item disabled">
                                    <span class="page-link">1</span>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            @else
                <div class="text-center py-5">
                    <div class="mb-4">
                        <i class="fas fa-film" style="font-size: 4rem; color: #dee2e6;"></i>
                    </div>
                    <h4 class="text-muted">Belum ada film favorit</h4>
                    <p class="text-muted">Mulai tambahkan film favoritmu dengan mencari dan menyimpan film yang kamu sukai</p>
                    <a href="{{ route('home') }}" class="btn btn-primary">
                        <i class="fas fa-search"></i> Cari Film Sekarang
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection