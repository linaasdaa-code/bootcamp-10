<?php
session_start();
$keranjang = $_SESSION['keranjang'] ?? [];

// ===== aksi: kurangi, hapus, kosongkan (dikerjakan SEBELUM header, supaya badge navbar ikut update) =====
$aksi = $_GET['aksi'] ?? '';
$id   = (int) ($_GET['id'] ?? 0);

if ($aksi === 'kurang' && isset($keranjang[$id])) {
    $keranjang[$id]--;
    if ($keranjang[$id] <= 0) unset($keranjang[$id]);
} elseif ($aksi === 'hapus') {
    unset($keranjang[$id]);
} elseif ($aksi === 'kosongkan') {
    $keranjang = [];
}
$_SESSION['keranjang'] = $keranjang;

$judul = 'Keranjang - Suvoire';
require_once 'header.php';

// ===== ambil detail produk yang ada di keranjang dari database =====
$items = [];
$total = 0;
if (count($keranjang) > 0) {
    // buat tanda tanya sebanyak jumlah id: "?, ?, ?"
    $placeholders = implode(',', array_fill(0, count($keranjang), '?'));
    $stmt = $pdo->prepare("SELECT * FROM products WHERE id IN ($placeholders)");
    $stmt->execute(array_keys($keranjang));
    foreach ($stmt->fetchAll() as $p) {
        $qty      = $keranjang[$p['id']];
        $subtotal = $p['harga'] * $qty;
        $total   += $subtotal;
        $items[]  = ['produk' => $p, 'qty' => $qty, 'subtotal' => $subtotal];
    }
}
?>
<h2 class="mb-4"><i class="bi bi-cart3"></i> Keranjang Belanja</h2>

<?php if (count($items) === 0): ?>
  <div class="alert alert-info">Keranjang masih kosong. <a href="index.php">Lihat produk</a></div>
<?php else: ?>
  <div class="card shadow-sm">
    <table class="table align-middle mb-0">
      <thead class="table-light">
        <tr>
          <th>Produk</th>
          <th class="text-end">Harga</th>
          <th class="text-center">Jumlah</th>
          <th class="text-end">Subtotal</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($items as $item): $p = $item['produk']; ?>
          <tr>
            <td>
              <div class="d-flex align-items-center gap-3">
                <?php if (!empty($p['gambar'])): ?>
                  <img src="<?= htmlspecialchars(urlGambar($p['gambar'])) ?>" alt="" style="width: 56px; height: 56px; object-fit: cover; border-radius: 6px;">
                <?php endif; ?>
                <div>
                  <strong><?= htmlspecialchars($p['nama_produk']) ?></strong><br>
                  <small class="text-muted"><?= htmlspecialchars($p['kategori']) ?></small>
                </div>
              </div>
            </td>
            <td class="text-end">Rp <?= number_format($p['harga'], 0, ',', '.') ?></td>
            <td class="text-center">
              <a href="keranjang.php?aksi=kurang&id=<?= $p['id'] ?>" class="btn btn-outline-secondary btn-sm">-</a>
              <span class="mx-2"><?= $item['qty'] ?></span>
              <a href="keranjang_tambah.php?id=<?= $p['id'] ?>" class="btn btn-outline-secondary btn-sm">+</a>
            </td>
            <td class="text-end fw-bold">Rp <?= number_format($item['subtotal'], 0, ',', '.') ?></td>
            <td class="text-end">
              <a href="keranjang.php?aksi=hapus&id=<?= $p['id'] ?>" class="btn btn-outline-danger btn-sm"><i class="bi bi-trash"></i></a>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
      <tfoot class="table-light">
        <tr>
          <th colspan="3" class="text-end">Total</th>
          <th class="text-end">Rp <?= number_format($total, 0, ',', '.') ?></th>
          <th></th>
        </tr>
      </tfoot>
    </table>
  </div>

  <div class="d-flex justify-content-between mt-3">
    <a href="keranjang.php?aksi=kosongkan" class="btn btn-outline-danger" onclick="return confirm('Kosongkan keranjang?')">Kosongkan Keranjang</a>
    <div>
      <a href="index.php" class="btn btn-outline-dark">Lanjut Belanja</a>
      <a href="#" class="btn btn-success" onclick="alert('Checkout akan dibuat di sesi berikutnya!'); return false;">Checkout</a>
    </div>
  </div>
<?php endif; ?>
<?php require_once 'footer.php'; ?>
