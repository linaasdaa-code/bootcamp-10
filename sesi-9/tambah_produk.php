<?php
$judul = 'Tambah Produk - Suvoire';
require_once 'header.php';
$kategoriList = ['Floral', 'Sweet', 'Fresh', 'Woody'];
?>
<div class="card shadow-sm mx-auto" style="max-width: 640px;">
  <div class="card-body p-4">
    <h2 class="mb-4">Tambah Produk</h2>
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
<?php require_once 'footer.php'; ?>
