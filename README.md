# FilmFavku - Aplikasi Manajemen Film Favorit

## Nama & NIM Mahasiswa

- **Nama:** HISYAM EKA PRAMUDITA
- **NIM:** 2307016

---

## Deskripsi Singkat

FilmFavku adalah aplikasi web sederhana untuk mengelola daftar film favorit.
Aplikasi ini mengambil data film dari API eksternal (api-filmapik), kemudian pengguna dapat menyimpan film favorit, memberikan rating, serta menambahkan catatan pribadi.

Project ini dibuat sebagai **media pembelajaran Laravel**, dengan gaya penulisan kode dan komentar yang sederhana serta menggunakan bahasa Indonesia yang kasual agar mudah dipahami oleh pemula.

---

## Teknologi yang Digunakan

- **Backend:** Laravel 12.x (PHP Framework)
- **Frontend:** Bootstrap 5, JavaScript
- **Database:** MySQL (lokal)
- **API:** api-filmapik
- **Build Tool:** Vite
- **Server:** PHP Built-in Server
- **Bahasa Pemrograman:** PHP 8.2+, JavaScript

---

## Cara Instalasi dan Menjalankan Aplikasi

### Prasyarat

- PHP 8.2 atau lebih tinggi
- Composer
- Node.js dan npm
- MySQL (Laragon / XAMPP)

---

### Instalasi

1. Clone repository:
   ```bash
   git clone <url-repository>
   cd FilmFavku-App
   ```

2. Install dependensi PHP:
   ```bash
   composer install
   ```

3. Copy file environment:
   ```bash
   cp .env.example .env
   ```

4. Generate application key:
   ```bash
   php artisan key:generate
   ```

5. Install dependensi JavaScript:
   ```bash
   npm install
   ```

6. Build asset frontend:
   ```bash
   npm run build
   ```

7. Pastikan MySQL (Laragon / XAMPP) berjalan

8. Atur database di file .env:
   ```
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=db_filmfavku
   DB_USERNAME=root
   DB_PASSWORD=
   ```

9. Jalankan migrasi:
   ```bash
   php artisan migrate
   ```

### Menjalankan Aplikasi
```bash
php artisan serve
```

Akses melalui browser:
```
http://localhost:8000
```

### Development (Hot Reload)
Terminal 1:
```bash
php artisan serve
```

Terminal 2:
```bash
npm run dev
```

## Fitur Utama

- Menampilkan daftar film dari API api-filmapik
- Pencarian film berdasarkan judul
- Menyimpan film ke daftar favorit
- Menambahkan rating film
- Menambahkan catatan pribadi
- Mengurutkan daftar film favorit
- Tampilan sederhana dan responsive

## API yang Digunakan

### Sumber API:
https://github.com/devnazir/api-filmapik

### Contoh Endpoint

#### Search Film
```
GET https://api-filmapik.vercel.app/api/search?q=avenger
```

#### Film Terbaru
```
GET https://api-filmapik.vercel.app/api/latest
```

#### Filter Negara
```
GET https://api-filmapik.vercel.app/api/country?search=france
```

#### Filter Kategori
```
GET https://api-filmapik.vercel.app/api/category?search=action
```

## Kolaborasi & Manajemen Git

### Skema Kerja Tim
Project ini dikerjakan oleh 3 orang dalam satu laptop dan satu repository GitHub, dengan pengaturan identitas Git yang berbeda.

Git tidak peduli siapa yang memakai laptop,
Git hanya mencatat siapa yang melakukan commit.

### Konfigurasi Git per Anggota

#### Anggota 1 (Hisyam)
```bash
git config --local user.name "Hisyam Eka Pramudita"
git config --local user.email "2307016@itg.ac.id"
```

#### Anggota 2 (Teman A)
```bash
git config --local user.name "Rendi"
git config --local user.email "syamhep@gmail.com"
```

#### Anggota 3 (Teman B)
```bash
git config --local user.name "Wida"
git config --local user.email "syamjoj@gmail.com"
```

### Pembagian Tugas Tim

#### 🧑‍💻 Anggota 1 — Backend API & Controller
**Nama:** Hisyam Eka Pramudita

**File:**
- app/Http/Controllers/HomeController.php
- app/Http/Controllers/FilmController.php
- routes/web.php

**Tugas:**
- Integrasi API api-filmapik
- Ambil data film terbaru, pencarian, dan detail film
- Parsing data API
- Routing utama aplikasi

#### 🧑‍💻 Anggota 2 — Database & CRUD
**Nama:** Rendi

**File:**
- database/migrations/xxxx_create_favorites_table.php
- app/Models/Favorite.php
- app/Http/Controllers/FavoriteController.php

**Tugas:**
- Desain tabel database favorites
- CRUD film favorit
- Validasi input rating dan catatan

#### 🧑‍💻 Anggota 3 — Frontend & Blade
**Nama:** Wida

**File:**
- resources/views/layouts/app.blade.php
- resources/views/home.blade.php
- resources/views/film/detail.blade.php
- resources/views/favorite/index.blade.php
- resources/views/favorite/edit.blade.php

**Tugas:**
- Tampilan UI menggunakan Bootstrap
- Blade template
- Form input favorit
- Responsif dan perapihan tampilan

## Catatan Penting

- Database lokal: db_filmfavku
- API tidak memerlukan API key
- Koneksi internet diperlukan
- Project dibuat untuk pembelajaran

## Lisensi
MIT License

## Akses Aplikasi

- Web: http://localhost:8000
- Database: http://localhost/phpmyadmin
- API: https://api-filmapik.vercel.app/api