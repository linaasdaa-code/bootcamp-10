<?php
// Form tambah produk: hanya menampilkan form, datanya diproses oleh simpan_produk.php
require_once 'koneksi_db.php';
$kategoriList = ['Floral', 'Sweet', 'Fresh', 'Woody'];
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tambah Produk - Suvoire</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">
  <nav class="navbar navbar-dark bg-dark">
    <div class="container">
      <a class="navbar-brand" href="index.php">SUVOIRE</a>
    </div>
  </nav>

  <div class="container py-5" style="max-width: 640px;">
    <div class="card shadow-sm">
      <div class="card-body p-4">
        <h2 class="mb-4">Tambah Produk</h2>

        <?php if (isset($_GET['error'])): ?>
          <div class="alert alert-danger"><?= htmlspecialchars($_GET['error']) ?></div>
        <?php endif; ?>

        <form action="simpan_produk.php" method="POST" enctype="multipart/form-data">
          <div class="mb-3">
            <label for="nama_produk" class="form-label">Nama Produk</label>
            <input type="text" id="nama_produk" name="nama_produk" class="form-control" required>
          </div>
          <div class="mb-3">
            <label for="harga" class="form-label">Harga</label>
            <input type="number" id="harga" name="harga" class="form-control" min="1" required>
          </div>
          <div class="mb-3">
            <label for="deskripsi" class="form-label">Deskripsi</label>
            <textarea id="deskripsi" name="deskripsi" class="form-control" rows="3" required></textarea>
          </div>
          <div class="mb-3">
            <label for="kategori" class="form-label">Kategori</label>
            <select id="kategori" name="kategori" class="form-select" required>
              <option value="">-- Pilih Kategori --</option>
              <?php foreach ($kategoriList as $kat): ?>
                <option value="<?= $kat ?>"><?= $kat ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="mb-3">
            <label for="stok" class="form-label">Stok</label>
            <input type="number" id="stok" name="stok" class="form-control" min="0" required>
          </div>
          <div class="mb-4">
            <label for="gambar" class="form-label">Foto Produk</label>
            <input type="file" id="gambar" name="gambar" class="form-control" accept="image/*" required>
          </div>
          <button type="submit" class="btn btn-dark w-100">Simpan Produk</button>
          <a href="index.php" class="btn btn-link w-100 mt-2">Kembali ke Etalase</a>
        </form>
      </div>
    </div>
  </div>
</body>
</html>
