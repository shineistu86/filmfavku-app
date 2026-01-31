# Dokumentasi Migrasi dan Model Favorites

## Deskripsi

File-file ini merupakan bagian dari fitur manajemen film favorit dalam aplikasi FilmFavku. Fitur ini memungkinkan pengguna untuk menyimpan film-film favorit mereka beserta informasi tambahan seperti rating dan catatan pribadi.

## File-file yang Dibuat

### 1. Migration: `create_favorites_table.php`
- Membuat tabel `favorites` di database
- Struktur tabel mencakup:
  - `id`: Primary key auto-increment
  - `film_id`: ID unik film dari API (unik)
  - `title`: Judul film
  - `year`: Tahun rilis film
  - `rating`: Rating film (desimal 1 angka, 1-10)
  - `notes`: Catatan pribadi pengguna
  - `poster_url`: URL poster film
  - `imdb_id`: ID IMDB film
  - `timestamps`: created_at dan updated_at

### 2. Model: `Favorite.php`
- Model Eloquent untuk tabel `favorites`
- Melindungi field-field yang dapat diisi (fillable)
- Casting field-field tertentu ke tipe data yang sesuai
- Menyediakan scope-query untuk pencarian dan filtering

### 3. Factory: `FavoriteFactory.php`
- Factory untuk membuat data dummy saat seeding atau testing
- Menggunakan Faker untuk menghasilkan data acak yang realistis

## Penggunaan

### Membuat record baru:
```php
$favorite = Favorite::create([
    'film_id' => 'tt0111161',
    'title' => 'The Shawshank Redemption',
    'year' => 1994,
    'rating' => 9.3,
    'notes' => 'Film favorit saya',
    'poster_url' => 'https://example.com/poster.jpg',
    'imdb_id' => 'tt0111161'
]);
```

### Menggunakan scope:
```php
// Ambil semua favorit terbaru
$favorites = Favorite::latest()->get();

// Cari berdasarkan judul
$favorites = Favorite::byTitle('Avenger')->get();

// Cari berdasarkan tahun
$favorites = Favorite::byYear(2023)->get();

// Cari berdasarkan rentang rating
$favorites = Favorite::byRatingRange(8.0, 10.0)->get();
```

## Validasi

Model ini digunakan bersamaan dengan validasi di controller untuk memastikan data yang disimpan valid dan sesuai dengan kebutuhan aplikasi.

## Kontributor

**Nama:** Rendi (2307017)  
**Tugas:** Desain tabel database favorites, CRUD film favorit, Validasi input rating dan catatan