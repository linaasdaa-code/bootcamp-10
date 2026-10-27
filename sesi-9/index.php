<?php
$judul = 'Suvoire - Etalase Produk';
require_once 'header.php';

// ===== READ: ambil produk dari database (dengan filter kategori) =====
$kategoriList = $pdo->query("SELECT DISTINCT kategori FROM products WHERE kategori IS NOT NULL ORDER BY kategori")->fetchAll(PDO::FETCH_COLUMN);
$kategoriDipilih = trim($_GET['kategori'] ?? '');

if ($kategoriDipilih === '') {
    $stmt = $pdo->query("SELECT * FROM products ORDER BY id");
} else {
    $stmt = $pdo->prepare("SELECT * FROM products WHERE kategori = ? ORDER BY id");
    $stmt->execute([$kategoriDipilih]);
}
$products = $stmt->fetchAll();
?>
<h2 class="mb-3">Etalase Produk</h2>

<div class="mb-4">
  <a href="index.php" class="btn btn-sm <?= $kategoriDipilih === '' ? 'btn-dark' : 'btn-outline-dark' ?>">Semua</a>
  <?php foreach ($kategoriList as $kat): ?>
    <a href="index.php?kategori=<?= urlencode($kat) ?>"
       class="btn btn-sm <?= $kategoriDipilih === $kat ? 'btn-dark' : 'btn-outline-dark' ?>"><?= htmlspecialchars($kat) ?></a>
  <?php endforeach; ?>
</div>

<p class="text-muted">Menampilkan <strong><?= count($products) ?></strong> produk.</p>

<?php if (count($products) === 0): ?>
  <div class="alert alert-warning">Tidak ada produk di kategori ini.</div>
<?php endif; ?>

<div class="row g-4">
  <?php foreach ($products as $p): ?>
    <div class="col-12 col-sm-6 col-lg-3">
      <div class="card h-100 shadow-sm">
        <?php if (!empty($p['gambar'])): ?>
          <img src="<?= htmlspecialchars(urlGambar($p['gambar'])) ?>" class="card-img-top" alt="<?= htmlspecialchars($p['nama_produk']) ?>" style="height: 180px; object-fit: cover;">
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
          <small class="text-muted mb-3">Stok: <?= $p['stok'] ?></small>

          <!-- CART: tambah ke keranjang -->
          <?php if ($p['stok'] > 0): ?>
            <a href="keranjang_tambah.php?id=<?= $p['id'] ?>" class="btn btn-warning btn-sm w-100 mb-2">
              <i class="bi bi-cart-plus"></i> Tambah ke Keranjang
            </a>
          <?php else: ?>
            <button class="btn btn-secondary btn-sm w-100 mb-2" disabled>Stok habis</button>
          <?php endif; ?>

          <!-- UPDATE & DELETE -->
          <div class="d-flex gap-2">
            <a href="edit_produk.php?id=<?= $p['id'] ?>" class="btn btn-outline-primary btn-sm flex-fill"><i class="bi bi-pencil"></i> Edit</a>
            <a href="hapus_produk.php?id=<?= $p['id'] ?>" class="btn btn-outline-danger btn-sm flex-fill"
               onclick="return confirm('Hapus produk <?= htmlspecialchars($p['nama_produk'], ENT_QUOTES) ?>?')"><i class="bi bi-trash"></i> Hapus</a>
          </div>
        </div>
      </div>
    </div>
  <?php endforeach; ?>
</div>
<?php require_once 'footer.php'; ?>
