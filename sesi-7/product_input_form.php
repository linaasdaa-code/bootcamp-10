<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Form Input Produk</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">
  <div class="container py-5" style="max-width: 640px;">
    <div class="card shadow-sm">
      <div class="card-body p-4">
        <h2 class="text-center mb-4">Form Input Produk</h2>

                <form action="product_input_process.php" method="POST" enctype="multipart/form-data">
          <div class="mb-3">
            <label for="nama" class="form-label">Nama Produk</label>
            <input type="text" id="nama" name="nama" class="form-control" placeholder="Masukkan nama produk">
          </div>

          <div class="mb-3">
            <label for="harga" class="form-label">Harga</label>
            <input type="number" id="harga" name="harga" class="form-control" placeholder="Masukkan harga">
          </div>

          <div class="mb-3">
            <label for="deskripsi" class="form-label">Deskripsi</label>
            <textarea id="deskripsi" name="deskripsi" class="form-control" rows="4" placeholder="Masukkan deskripsi produk"></textarea>
          </div>

          <div class="mb-3">
            <label for="kategori" class="form-label">Kategori</label>
            <select id="kategori" name="kategori" class="form-select">
              <option value="">-- Pilih Kategori --</option>
              <option value="Floral">Floral</option>
              <option value="Sweet">Sweet</option>
              <option value="Fresh">Fresh</option>
              <option value="Woody">Woody</option>
            </select>
          </div>

          <div class="mb-4">
            <label for="stok" class="form-label">Stok</label>
            <input type="number" id="stok" name="stok" class="form-control" placeholder="Masukkan jumlah stok">
</div>

          <div class="mb-4">
            <label for="gambar" class="form-label">Gambar Produk</label>
            <input type="file" id="gambar" name="gambar" class="form-control" accept="image/*">
          </div>

          <button type="submit" class="btn btn-primary w-100">Kirim Produk</button>
        </form>
      </div>
    </div>
  </div>
</body>
</html>