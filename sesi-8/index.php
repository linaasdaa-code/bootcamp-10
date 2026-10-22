<?php
// ===== 1. HUBUNGKAN KE DATABASE =====
require_once 'koneksi_db.php';

// ===== 2. AMBIL DAFTAR KATEGORI (untuk tombol filter) =====
$kategoriList = $pdo->query("SELECT DISTINCT kategori FROM products WHERE kategori IS NOT NULL ORDER BY kategori")->fetchAll(PDO::FETCH_COLUMN);

// ===== 3. BACA FILTER DARI URL (?kategori=Floral) =====
$kategoriDipilih = trim($_GET['kategori'] ?? '');

// ===== 4. AMBIL PRODUK DARI DATABASE =====
if ($kategoriDipilih === '') {
    // tanpa filter: semua produk
    $stmt = $pdo->query("SELECT * FROM products ORDER BY id");
} else {
    // dengan filter: hanya kategori yang dipilih
    $stmt = $pdo->prepare("SELECT * FROM products WHERE kategori = ? ORDER BY id");
    $stmt->execute([$kategoriDipilih]);
}
$products = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Suvoire - Etalase Produk</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">
  <nav class="navbar navbar-dark bg-dark">
    <div class="container">
      <a class="navbar-brand" href="index.php">SUVOIRE</a>
    </div>
  </nav>

  <div class="container py-4">
    <h2 class="mb-3">Etalase Produk</h2>

    <!-- ===== 5. TOMBOL FILTER KATEGORI ===== -->
    <div class="mb-4">
      <a href="index.php" class="btn btn-sm <?= $kategoriDipilih === '' ? 'btn-dark' : 'btn-outline-dark' ?>">Semua</a>
      <?php foreach ($kategoriList as $kat): ?>
        <a href="index.php?kategori=<?= urlencode($kat) ?>"
           class="btn btn-sm <?= $kategoriDipilih === $kat ? 'btn-dark' : 'btn-outline-dark' ?>">
          <?= htmlspecialchars($kat) ?>
        </a>
      <?php endforeach; ?>
    </div>

    <p class="text-muted">Menampilkan <strong><?= count($products) ?></strong> produk<?= $kategoriDipilih !== '' ? ' kategori <strong>' . htmlspecialchars($kategoriDipilih) . '</strong>' : '' ?>.</p>

    <!-- ===== 6. TAMPILKAN PRODUK DENGAN LOOPING ===== -->
    <?php if (count($products) === 0): ?>
      <div class="alert alert-warning">Tidak ada produk di kategori ini.</div>
    <?php endif; ?>

    <div class="row g-4">
      <?php foreach ($products as $p): ?>
        <div class="col-12 col-sm-6 col-lg-3">
          <div class="card h-100 shadow-sm">
            <?php if (!empty($p['gambar'])): ?>
              <?php // kalau diawali http = alamat internet, kalau tidak = nama file di folder uploads/
                    $src = str_starts_with($p['gambar'], 'http') ? $p['gambar'] : 'uploads/' . $p['gambar']; ?>
              <img src="<?= htmlspecialchars($src) ?>" class="card-img-top" alt="<?= htmlspecialchars($p['nama_produk']) ?>" style="height: 180px; object-fit: cover;">
            <?php else: ?>
              <div class="bg-secondary-subtle d-flex align-items-center justify-content-center" style="height: 180px;">
                <span class="text-muted">Tidak ada gambar</span>
              </div>
            <?php endif; ?>
            <div class="card-body d-flex flex-column">
              <span class="badge text-bg-light border align-self-start mb-2"><?= htmlspecialchars($p['kategori']) ?></span>
              <h5 class="card-title"><?= htmlspecialchars($p['nama_produk']) ?></h5>
              <p class="card-text text-muted small flex-grow-1"><?= htmlspecialchars($p['deskripsi']) ?></p>
              <p class="fw-bold mb-1">Rp <?= number_format($p['harga'], 0, ',', '.') ?></p>
              <small class="text-muted">Stok: <?= $p['stok'] ?></small>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</body>
</html>
