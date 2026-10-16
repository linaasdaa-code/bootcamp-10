<?php
// ===== 1. AMBIL DATA DARI FORM =====
$nama      = trim($_POST['nama'] ?? '');
$harga     = trim($_POST['harga'] ?? '');
$deskripsi = trim($_POST['deskripsi'] ?? '');
$kategori  = trim($_POST['kategori'] ?? '');
$stok      = trim($_POST['stok'] ?? '');

// ===== 2. VALIDASI =====
$errors = [];

if ($nama === '') {
    $errors[] = 'Nama produk wajib diisi.';
}

if ($harga === '') {
    $errors[] = 'Harga wajib diisi.';
} elseif (!is_numeric($harga) || $harga <= 0) {
    $errors[] = 'Harga harus berupa angka lebih dari 0.';
}

if ($deskripsi === '') {
    $errors[] = 'Deskripsi wajib diisi.';
}

if ($kategori === '') {
    $errors[] = 'Kategori wajib dipilih.';
}

if ($stok === '') {
    $errors[] = 'Stok wajib diisi.';
} elseif (!is_numeric($stok) || $stok < 0) {
    $errors[] = 'Stok harus berupa angka 0 atau lebih.';
}

$gambar = $_FILES['gambar'] ?? null;
$namaGambar = '';
$ext = '';

if (!$gambar || $gambar['error'] !== UPLOAD_ERR_OK) {
    $errors[] = 'Gambar produk wajib diupload.';
} else {
    $ext = strtolower(pathinfo($gambar['name'], PATHINFO_EXTENSION));
    $boleh = ['jpg', 'jpeg', 'png', 'webp'];
    if (!in_array($ext, $boleh)) {
        $errors[] = 'Gambar harus berformat jpg, jpeg, png, atau webp.';
    }
}

// ===== 3. HITUNG DENGAN OPERATOR =====
$totalNilai = 0;
if (count($errors) === 0) {
    $totalNilai = $harga * $stok;
    $namaGambar = time() . '.' . $ext;
        move_uploaded_file($gambar['tmp_name'], 'uploads/' . $namaGambar);
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Hasil Input Produk</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">
  <div class="container py-5" style="max-width: 640px;">

    <?php if (count($errors) > 0): ?>
      <div class="alert alert-danger">
        <h5>Data belum lengkap:</h5>
        <ul class="mb-0">
          <?php foreach ($errors as $error): ?>
            <li><?= $error ?></li>
          <?php endforeach; ?>
        </ul>
      </div>
      <a href="product_input_form.php" class="btn btn-secondary">Kembali ke Form</a>

    <?php else: ?>
      <div class="alert alert-success">Produk berhasil diterima!</div>
      <div class="card">
        <img src="uploads/<?= $namaGambar ?>" class="card-img-top" alt="<?= htmlspecialchars($nama) ?>">
        <div class="card-body">
          <h4 class="card-title"><?= htmlspecialchars($nama) ?></h4>
          <p class="card-text"><?= htmlspecialchars($deskripsi) ?></p>
          <ul class="list-group list-group-flush">
            <li class="list-group-item"><strong>Kategori:</strong> <?= htmlspecialchars($kategori) ?></li>
            <li class="list-group-item"><strong>Harga:</strong> Rp <?= number_format($harga, 0, ',', '.') ?></li>
            <li class="list-group-item"><strong>Stok:</strong> <?= $stok ?></li>
            <li class="list-group-item"><strong>Total nilai stok:</strong> Rp <?= number_format($totalNilai, 0, ',', '.') ?></li>
          </ul>
        </div>
      </div>
      <a href="product_input_form.php" class="btn btn-primary mt-3">Tambah Produk Lagi</a>
    <?php endif; ?>

  </div>
</body>
</html>