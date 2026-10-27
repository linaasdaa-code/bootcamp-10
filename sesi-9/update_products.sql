-- =====================================================
-- SESI 8: MENYIAPKAN TABEL PRODUCTS UNTUK ETALASE
-- Jalankan di MySQL: mysql -u root -p < sesi-8/update_products.sql
-- =====================================================
USE suvoire_db;

-- 1. Tambah kolom kategori dan gambar (belum ada di sesi 6)
ALTER TABLE products ADD COLUMN kategori VARCHAR(50);
ALTER TABLE products ADD COLUMN gambar VARCHAR(255);

-- 2. Isi kategori untuk produk yang sudah ada
UPDATE products SET kategori = 'Floral' WHERE nama_produk = 'French Rose';
UPDATE products SET kategori = 'Sweet'  WHERE nama_produk = 'Vanilla Soft';
UPDATE products SET kategori = 'Fresh'  WHERE nama_produk = 'Osmanthus Tea';

-- 3. Tambah produk baru supaya setiap kategori ada isinya
INSERT INTO products (nama_produk, harga, deskripsi, stok, kategori) VALUES
('Rose Oud',      189000, 'Mawar dan kayu oud yang mewah.',        5, 'Woody'),
('Sandalwood',    169000, 'Kayu cendana hangat dan menenangkan.',  8, 'Woody'),
('Peony Bloom',   149000, 'Bunga peony segar di pagi hari.',      12, 'Floral'),
('Caramel Latte', 139000, 'Karamel manis dan kopi susu.',         10, 'Sweet'),
('Sea Breeze',    129000, 'Angin laut dan garam segar.',          14, 'Fresh');

-- 4. Cek hasilnya
SELECT id, nama_produk, harga, stok, kategori FROM products;
