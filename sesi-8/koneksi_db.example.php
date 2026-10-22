<?php
// ===== KONEKSI PHP KE MYSQL =====
$host     = 'localhost';
$dbname   = 'suvoire_db';
$username = 'root';
$password = 'Dargbal2026!';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die('Koneksi ke database gagal: ' . $e->getMessage());
}