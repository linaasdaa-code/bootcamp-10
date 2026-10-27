<?php
$judul = 'Edit Produk - Suvoire';
require_once 'header.php';
$kategoriList = ['Floral', 'Sweet', 'Fresh', 'Woody'];

// ===== UPDATE (bagian 1): ambil data lama untuk mengisi form =====
$id = (int) ($_GET['id'] ?? 0);
$stmt = $pdo->prepare("SELECT * FROM products WHERE id = ?");
$stmt->execute([$id]);
$p = $stmt->fetch();

if (!$p) {
    echo '<div class="alert alert-danger">Produk tidak ditemukan.</div>';
    require_once 'footer.php';
    exit;
}
?>
<div class="card shadow-sm mx-auto" style="max-width: 640px;">
  <div class="card-body p-4">
    <h2 class="mb-4">Edit Produk</h2>
    <form action="update_produk.php" method="POST" enctype="multipart/form-data">
      <!-- id dikirim tersembunyi supaya tahu produk mana yang diubah -->
      <input type="hidden" name="id" value="<?= $p['id'] ?>">

      <div class="mb-3">
        <label for="nama_produk" class="form-label">Nama Produk</label>
        <input type="text" id="nama_produk" name="nama_produk" class="form-control" value="<?= htmlspecialchars($p['nama_produk']) ?>" required>
      </div>
      <div class="mb-3">
        <label for="harga" class="form-label">Harga</label>
        <input type="number" id="harga" name="harga" class="form-control" min="1" value="<?= $p['harga'] ?>" required>
      </div>
      <div class="mb-3">
        <label for="deskripsi" class="form-label">Deskripsi</label>
        <textarea id="deskripsi" name="deskripsi" class="form-control" rows="3" required><?= htmlspecialchars($p['deskripsi']) ?></textarea>
      </div>
      <div class="mb-3">
        <label for="kategori" class="form-label">Kategori</label>
        <select id="kategori" name="kategori" class="form-select" required>
          <?php foreach ($kategoriList as $kat): ?>
            <option value="<?= $kat ?>" <?= $p['kategori'] === $kat ? 'selected' : '' ?>><?= $kat ?></option>
          <?php endforeach; ?>
        </select>
      </div>
      <div class="mb-3">
        <label for="stok" class="form-label">Stok</label>
        <input type="number" id="stok" name="stok" class="form-control" min="0" value="<?= $p['stok'] ?>" required>
      </div>
      <div class="mb-4">
        <label for="gambar" class="form-label">Ganti Foto (opsional)</label>
        <?php if (!empty($p['gambar'])): ?>
          <div class="mb-2"><img src="<?= htmlspecialchars(urlGambar($p['gambar'])) ?>" alt="" style="height: 80px; border-radius: 6px;"></div>
        <?php endif; ?>
        <input type="file" id="gambar" name="gambar" class="form-control" accept="image/*">
        <div class="form-text">Kosongkan kalau tidak ingin mengganti foto.</div>
      </div>
      <button type="submit" class="btn btn-primary w-100">Simpan Perubahan</button>
      <a href="index.php" class="btn btn-link w-100 mt-2">Batal</a>
    </form>
  </div>
</div>
<?php require_once 'footer.php'; ?>
