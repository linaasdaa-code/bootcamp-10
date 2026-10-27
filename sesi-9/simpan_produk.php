<?php
// ===== CREATE: simpan produk baru ke database =====
require_once 'koneksi_db.php';

$nama      = trim($_POST['nama_produk'] ?? '');
$harga     = trim($_POST['harga'] ?? '');
$deskripsi = trim($_POST['deskripsi'] ?? '');
$kategori  = trim($_POST['kategori'] ?? '');
$stok      = trim($_POST['stok'] ?? '');
$gambar    = $_FILES['gambar'] ?? null;

function kembaliDenganError($pesan) {
    header('Location: tambah_produk.php?error=' . urlencode($pesan));
    exit;
}

if ($nama === '' || $harga === '' || $deskripsi === '' || $kategori === '' || $stok === '') {
    kembaliDenganError('Semua field wajib diisi.');
}
if (!is_numeric($harga) || $harga <= 0) kembaliDenganError('Harga harus berupa angka lebih dari 0.');
if (!is_numeric($stok) || $stok < 0)   kembaliDenganError('Stok harus berupa angka 0 atau lebih.');
if (!$gambar || $gambar['error'] !== UPLOAD_ERR_OK) kembaliDenganError('Foto produk wajib diupload.');

$ext   = strtolower(pathinfo($gambar['name'], PATHINFO_EXTENSION));
$boleh = ['jpg', 'jpeg', 'png', 'webp'];
if (!in_array($ext, $boleh)) kembaliDenganError('Foto harus berformat jpg, jpeg, png, atau webp.');

$namaFile = time() . '-' . rand(1000, 9999) . '.' . $ext;
move_uploaded_file($gambar['tmp_name'], 'uploads/' . $namaFile);

$stmt = $pdo->prepare("INSERT INTO products (nama_produk, harga, deskripsi, stok, kategori, gambar) VALUES (?, ?, ?, ?, ?, ?)");
$stmt->execute([$nama, $harga, $deskripsi, $stok, $kategori, $namaFile]);

header('Location: index.php?pesan=' . urlencode('Produk berhasil ditambahkan.'));
exit;
