<?php
// ===== CART: tambah produk ke keranjang (disimpan di session) =====
session_start();
require_once 'koneksi_db.php';

$id = (int) ($_GET['id'] ?? 0);

// pastikan produknya ada
$stmt = $pdo->prepare("SELECT id, nama_produk, stok FROM products WHERE id = ?");
$stmt->execute([$id]);
$p = $stmt->fetch();

if (!$p) {
    header('Location: index.php?error=' . urlencode('Produk tidak ditemukan.'));
    exit;
}

// keranjang = array [id_produk => jumlah]
$qtySekarang = $_SESSION['keranjang'][$id] ?? 0;

if ($qtySekarang + 1 > $p['stok']) {
    header('Location: index.php?error=' . urlencode('Stok ' . $p['nama_produk'] . ' tidak mencukupi.'));
    exit;
}

$_SESSION['keranjang'][$id] = $qtySekarang + 1;

header('Location: index.php?pesan=' . urlencode($p['nama_produk'] . ' ditambahkan ke keranjang.'));
exit;
