# Dokumentasi API - FilmFavku

## API Eksternal: api-filmapik

Base URL: `https://api-filmapik.vercel.app/api`

### Endpoint yang Tersedia

#### 1. Cari Film
- **URL**: `/search`
- **Method**: GET
- **Parameter**:
  - `q` (string, required): Kata kunci pencarian film
- **Contoh**: `GET /search?q=avenger`
- **Response**:
  ```json
  {
    "results": [
      {
        "id": "tt4154756",
        "title": "Avengers: Endgame",
        "year": "2019",
        "poster": "https://image.tmdb.org/t/p/w500/ifg55V1iSFZUqR1pAdPc7C5KBNh.jpg",
        "imdb_rating": "8.4"
      }
    ]
  }
  ```

#### 2. Film Terbaru
- **URL**: `/latest`
- **Method**: GET
- **Contoh**: `GET /latest`
- **Response**:
  ```json
  {
    "results": [
      {
        "id": "tt1234567",
        "title": "Film Terbaru",
        "year": "2023",
        "poster": "https://example.com/poster.jpg",
        "imdb_rating": "7.5"
      }
    ]
  }
  ```

#### 3. Detail Film
- **URL**: `/detail/{id}`
- **Method**: GET
- **Parameter**:
  - `id` (string, required): ID film dari IMDB
- **Contoh**: `GET /detail/tt4154756`
- **Response**:
  ```json
  {
    "id": "tt4154756",
    "title": "Avengers: Endgame",
    "year": "2019",
    "runtime": "181 min",
    "genre": "Action, Adventure, Drama",
    "director": "Anthony Russo, Joe Russo",
    "actors": "Robert Downey Jr., Chris Evans, Mark Ruffalo",
    "plot": "After the devastating events of...",
    "poster": "https://image.tmdb.org/t/p/w500/ifg55V1iSFZUqR1pAdPc7C5KBNh.jpg",
    "imdb_rating": "8.4",
    "trailer": "https://youtube.com/watch?v=TcMBFSGVi1c"
  }
  ```

#### 4. Film Berdasarkan Negara
- **URL**: `/country`
- **Method**: GET
- **Parameter**:
  - `search` (string, required): Nama negara
- **Contoh**: `GET /country?search=france`
- **Response**:
  ```json
  {
    "results": [
      {
        "id": "tt0118715",
        "title": "The Big Blue",
        "year": "1988",
        "country": "France",
        "poster": "https://example.com/poster.jpg"
      }
    ]
  }
  ```

#### 5. Film Berdasarkan Kategori
- **URL**: `/category`
- **Method**: GET
- **Parameter**:
  - `search` (string, required): Nama kategori/genre
- **Contoh**: `GET /category?search=action`
- **Response**:
  ```json
  {
    "results": [
      {
        "id": "tt4154756",
        "title": "Avengers: Endgame",
        "year": "2019",
        "genre": "Action",
        "poster": "https://image.tmdb.org/t/p/w500/ifg55V1iSFZUqR1pAdPc7C5KBNh.jpg"
      }
    ]
  }
  ```

## Konfigurasi di Laravel

### Environment Variable
```env
FILMAPIK_API_URL=https://api-filmapik.vercel.app/api
FILMAPIK_TIMEOUT=30
```

### Konfigurasi File
File: `config/filmapik.php`
```php
<?php
return [
    'filmapik' => [
        'base_url' => env('FILMAPIK_API_URL', 'https://api-filmapik.vercel.app/api'),
        'timeout' => env('FILMAPIK_TIMEOUT', 30),
    ],
];
```

### Penggunaan di Controller
```php
$response = Http::timeout(config('filmapik.timeout'))->get(config('filmapik.base_url') . '/latest');
```

## Error Handling

Jika API eksternal tidak merespons dalam waktu yang ditentukan (timeout), aplikasi akan menampilkan pesan error kepada pengguna dan mencatat error tersebut untuk debugging.