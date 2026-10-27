<?php
// ===== UPDATE (bagian 2): simpan perubahan ke database =====
require_once 'koneksi_db.php';

$id        = (int) ($_POST['id'] ?? 0);
$nama      = trim($_POST['nama_produk'] ?? '');
$harga     = trim($_POST['harga'] ?? '');
$deskripsi = trim($_POST['deskripsi'] ?? '');
$kategori  = trim($_POST['kategori'] ?? '');
$stok      = trim($_POST['stok'] ?? '');
$gambar    = $_FILES['gambar'] ?? null;

function kembaliDenganError($id, $pesan) {
    header("Location: edit_produk.php?id=$id&error=" . urlencode($pesan));
    exit;
}

if ($nama === '' || $harga === '' || $deskripsi === '' || $kategori === '' || $stok === '') {
    kembaliDenganError($id, 'Semua field wajib diisi.');
}
if (!is_numeric($harga) || $harga <= 0) kembaliDenganError($id, 'Harga harus berupa angka lebih dari 0.');
if (!is_numeric($stok) || $stok < 0)   kembaliDenganError($id, 'Stok harus berupa angka 0 atau lebih.');

// ambil nama gambar lama
$stmt = $pdo->prepare("SELECT gambar FROM products WHERE id = ?");
$stmt->execute([$id]);
$gambarLama = $stmt->fetchColumn();
$namaFile   = $gambarLama;

// kalau ada foto baru yang diupload, ganti
if ($gambar && $gambar['error'] === UPLOAD_ERR_OK) {
    $ext   = strtolower(pathinfo($gambar['name'], PATHINFO_EXTENSION));
    $boleh = ['jpg', 'jpeg', 'png', 'webp'];
    if (!in_array($ext, $boleh)) kembaliDenganError($id, 'Foto harus berformat jpg, jpeg, png, atau webp.');

    $namaFile = time() . '-' . rand(1000, 9999) . '.' . $ext;
    move_uploaded_file($gambar['tmp_name'], 'uploads/' . $namaFile);

    // hapus file foto lama kalau itu file lokal
    if ($gambarLama && !str_starts_with($gambarLama, 'http') && file_exists('uploads/' . $gambarLama)) {
        unlink('uploads/' . $gambarLama);
    }
}

$stmt = $pdo->prepare("UPDATE products SET nama_produk = ?, harga = ?, deskripsi = ?, stok = ?, kategori = ?, gambar = ? WHERE id = ?");
$stmt->execute([$nama, $harga, $deskripsi, $stok, $kategori, $namaFile, $id]);

header('Location: index.php?pesan=' . urlencode('Produk berhasil diperbarui.'));
exit;
