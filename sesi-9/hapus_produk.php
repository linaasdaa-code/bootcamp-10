<?php
// ===== DELETE: hapus produk dari database =====
session_start();
require_once 'koneksi_db.php';

$id = (int) ($_GET['id'] ?? 0);

// ambil nama gambar dulu supaya file-nya ikut dihapus
$stmt = $pdo->prepare("SELECT gambar FROM products WHERE id = ?");
$stmt->execute([$id]);
$gambar = $stmt->fetchColumn();

if ($gambar && !str_starts_with($gambar, 'http') && file_exists('uploads/' . $gambar)) {
    unlink('uploads/' . $gambar);
}

$stmt = $pdo->prepare("DELETE FROM products WHERE id = ?");
$stmt->execute([$id]);

// keluarkan juga dari keranjang kalau ada
unset($_SESSION['keranjang'][$id]);

header('Location: index.php?pesan=' . urlencode('Produk berhasil dihapus.'));
exit;
