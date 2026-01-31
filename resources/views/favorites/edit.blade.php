@extends('layouts.app')

@section('title', 'Edit Film Favorit - FilmFavku')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4>Edit Film Favorit</h4>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('favorites.update', $favorite->id) }}">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="title" class="form-label">Judul Film</label>
                            <input type="text" class="form-control" id="title" value="{{ $favorite->title }}" readonly>
                        </div>

                        <div class="mb-3">
                            <label for="year" class="form-label">Tahun Rilis</label>
                            <input type="text" class="form-control" id="year" value="{{ $favorite->year ?: 'N/A' }}" readonly>
                        </div>

                        <div class="mb-3">
                            <label for="rating" class="form-label">Rating (1-10)</label>
                            <input type="range" class="form-range" min="1" max="10" step="0.5" name="rating" id="rating" value="{{ $favorite->rating ?: 0 }}">
                            <div class="mt-2">
                                <span class="badge bg-primary">Rating: <span id="ratingValue">{{ $favorite->rating ?: 0 }}</span>/10</span>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="notes" class="form-label">Catatan Pribadi</label>
                            <textarea class="form-control" name="notes" id="notes" rows="3" placeholder="Tambahkan catatan tentang film ini...">{{ $favorite->notes ?: '' }}</textarea>
                        </div>

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <a href="{{ route('favorites.index') }}" class="btn btn-secondary me-md-2">
                                <i class="fas fa-arrow-left"></i> Kembali
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@section('scripts')
<script>
    // Update rating value display
    const ratingInput = document.getElementById('rating');
    const ratingValue = document.getElementById('ratingValue');

    ratingInput.addEventListener('input', function() {
        ratingValue.textContent = this.value;
    });
</script>
@endsection