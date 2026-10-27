<?php
// Bagian atas yang dipakai semua halaman: session, koneksi, navbar
if (session_status() === PHP_SESSION_NONE) session_start();
require_once 'koneksi_db.php';

// hitung jumlah barang di keranjang untuk badge di navbar
$jumlahKeranjang = 0;
foreach ($_SESSION['keranjang'] ?? [] as $qty) {
    $jumlahKeranjang += $qty;
}

// fungsi kecil untuk menampilkan gambar (alamat internet atau file di uploads/)
function urlGambar($gambar) {
    if (empty($gambar)) return '';
    return str_starts_with($gambar, 'http') ? $gambar : 'uploads/' . $gambar;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= $judul ?? 'Suvoire' ?></title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body class="bg-light">
  <nav class="navbar navbar-dark bg-dark">
    <div class="container">
      <a class="navbar-brand" href="index.php">SUVOIRE</a>
      <div class="d-flex gap-2">
        <a href="tambah_produk.php" class="btn btn-outline-light btn-sm"><i class="bi bi-plus-lg"></i> Tambah Produk</a>
        <a href="keranjang.php" class="btn btn-warning btn-sm position-relative">
          <i class="bi bi-cart3"></i> Keranjang
          <?php if ($jumlahKeranjang > 0): ?>
            <span class="badge rounded-pill text-bg-danger ms-1"><?= $jumlahKeranjang ?></span>
          <?php endif; ?>
        </a>
      </div>
    </div>
  </nav>

  <div class="container py-4">
    <?php if (isset($_GET['pesan'])): ?>
      <div class="alert alert-success alert-dismissible">
        <?= htmlspecialchars($_GET['pesan']) ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
      </div>
    <?php endif; ?>
    <?php if (isset($_GET['error'])): ?>
      <div class="alert alert-danger alert-dismissible">
        <?= htmlspecialchars($_GET['error']) ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
      </div>
    <?php endif; ?>
