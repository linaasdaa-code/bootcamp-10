<?php
// ===== PROSES SIMPAN PRODUK KE DATABASE =====
require_once 'koneksi_db.php';

// 1. Ambil data dari form (sama seperti sesi 7)
$nama      = trim($_POST['nama_produk'] ?? '');
$harga     = trim($_POST['harga'] ?? '');
$deskripsi = trim($_POST['deskripsi'] ?? '');
$kategori  = trim($_POST['kategori'] ?? '');
$stok      = trim($_POST['stok'] ?? '');
$gambar    = $_FILES['gambar'] ?? null;

// Fungsi kecil: kembali ke form sambil membawa pesan error
function kembaliDenganError($pesan) {
    header('Location: tambah_produk.php?error=' . urlencode($pesan));
    exit;
}

// 2. Validasi
if ($nama === '' || $harga === '' || $deskripsi === '' || $kategori === '' || $stok === '') {
    kembaliDenganError('Semua field wajib diisi.');
}
if (!is_numeric($harga) || $harga <= 0) {
    kembaliDenganError('Harga harus berupa angka lebih dari 0.');
}
if (!is_numeric($stok) || $stok < 0) {
    kembaliDenganError('Stok harus berupa angka 0 atau lebih.');
}
if (!$gambar || $gambar['error'] !== UPLOAD_ERR_OK) {
    kembaliDenganError('Foto produk wajib diupload.');
}

$ext   = strtolower(pathinfo($gambar['name'], PATHINFO_EXTENSION));
$boleh = ['jpg', 'jpeg', 'png', 'webp'];
if (!in_array($ext, $boleh)) {
    kembaliDenganError('Foto harus berformat jpg, jpeg, png, atau webp.');
}

// 3. Simpan file foto ke folder uploads/ dengan nama unik
$namaFile = time() . '-' . rand(1000, 9999) . '.' . $ext;
move_uploaded_file($gambar['tmp_name'], 'uploads/' . $namaFile);

// 4. Simpan data produk ke database (INSERT, dengan prepared statement)
$stmt = $pdo->prepare(
    "INSERT INTO products (nama_produk, harga, deskripsi, stok, kategori, gambar)
     VALUES (?, ?, ?, ?, ?, ?)"
);
$stmt->execute([$nama, $harga, $deskripsi, $stok, $kategori, $namaFile]);

// 5. Kembali ke etalase
header('Location: index.php?sukses=1');
exit;
