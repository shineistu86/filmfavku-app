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
            @if($favorites->count() > 0)
                <div class="row">
                    @foreach($favorites as $favorite)
                    <div class="col-md-3 col-sm-6 mb-4">
                        <div class="card h-100">
                            @if($favorite->poster_url)
                                <img src="{{ $favorite->poster_url }}" class="card-img-top" alt="{{ $favorite->title }}" style="height: 300px; object-fit: cover;">
                            @else
                                <img src="https://placehold.co/300x450/eee/aaa?text=No+Image" class="card-img-top" alt="{{ $favorite->title }}" style="height: 300px; object-fit: cover;">
                            @endif

                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title">{{ Str::limit($favorite->title, 30) }}</h5>
                                <p class="card-text">
                                    <small class="text-muted">Tahun: {{ $favorite->year ?: 'N/A' }}</small><br>
                                    <small>Rating:
                                        @for($i = 1; $i <= 10; $i++)
                                            @if($i <= $favorite->rating)
                                                <i class="fas fa-star text-warning"></i>
                                            @else
                                                <i class="far fa-star text-warning"></i>
                                            @endif
                                        @endfor
                                        ({{ $favorite->rating ?: '0' }}/10)
                                    </small>
                                </p>

                                @if($favorite->notes)
                                    <p class="card-text"><small class="text-muted">{{ Str::limit($favorite->notes, 50) }}</small></p>
                                @endif

                                <div class="mt-auto">
                                    <div class="d-grid gap-2">
                                        <a href="{{ route('favorites.edit', $favorite->id) }}" class="btn btn-sm btn-outline-primary">
                                            <i class="fas fa-edit"></i> Edit
                                        </a>
                                        <form action="{{ route('favorites.destroy', $favorite->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Yakin ingin menghapus film ini dari favorit?')">
                                                <i class="fas fa-trash"></i> Hapus
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            @else
                <div class="alert alert-info" role="alert">
                    <i class="fas fa-info-circle"></i> Kamu belum memiliki film favorit. Mulai tambahkan film favoritmu sekarang!
                </div>
            @endif
        </div>
    </div>
</div>
@endsection