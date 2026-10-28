<?php
$dbHost = 'localhost';
$dbName = 'db_inventaris_gudang';
$dbUser = 'root';
$dbPass = '';        // Default XAMPP kosong. Sesuaikan jika berbeda.

try {
    $pdo = new PDO(
        "mysql:host=$dbHost;dbname=$dbName;charset=utf8mb4",
        $dbUser,
        $dbPass,
        [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ]
    );
} catch (PDOException $e) {
    // Jangan tampilkan detail error ke pengguna pada aplikasi sungguhan.
    die('Koneksi database gagal / Database connection failed.');
}