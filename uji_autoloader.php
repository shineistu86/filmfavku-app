<?php
// uji_autoloader.php
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