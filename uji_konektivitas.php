<?php
// uji_konektivitas.php
require_once __DIR__.'/vendor/autoload.php';

echo "Autoloader berhasil dimuat!\n";

// Coba instantiate kelas dasar Laravel
try {
    $app = new Illuminate\Foundation\Application(
        $_ENV['APP_BASE_PATH'] ?? dirname(__DIR__)
    );
    echo "Instansiasi aplikasi berhasil!\n";
} catch (Exception $e) {
    echo "Gagal menginstansiasi aplikasi: " . $e->getMessage() . "\n";
}

// Coba akses konfigurasi
try {
    if(file_exists(__DIR__.'/config/app.php')) {
        $config = require __DIR__.'/config/app.php';
        echo "File konfigurasi dapat diakses\n";
    } else {
        echo "File konfigurasi tidak ditemukan\n";
    }
} catch (Exception $e) {
    echo "Gagal mengakses konfigurasi: " . $e->getMessage() . "\n";
}