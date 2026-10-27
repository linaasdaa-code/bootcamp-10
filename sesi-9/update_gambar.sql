-- =====================================================
-- SESI 8: ISI KOLOM GAMBAR
-- Jalankan: mysql -u root -p < sesi-8/update_gambar.sql
-- Boleh berisi alamat internet (https://...) atau nama file di folder uploads/
-- =====================================================
USE suvoire_db;

UPDATE products SET gambar = 'https://loremflickr.com/400/300/rose,candle'    WHERE nama_produk = 'French Rose';
UPDATE products SET gambar = 'https://loremflickr.com/400/300/vanilla,candle' WHERE nama_produk = 'Vanilla Soft';
UPDATE products SET gambar = 'https://loremflickr.com/400/300/tea,flower'     WHERE nama_produk = 'Osmanthus Tea';
UPDATE products SET gambar = 'https://loremflickr.com/400/300/oud,perfume'    WHERE nama_produk = 'Rose Oud';
UPDATE products SET gambar = 'https://loremflickr.com/400/300/sandalwood'     WHERE nama_produk = 'Sandalwood';
UPDATE products SET gambar = 'https://loremflickr.com/400/300/peony'          WHERE nama_produk = 'Peony Bloom';
UPDATE products SET gambar = 'https://loremflickr.com/400/300/caramel,latte'  WHERE nama_produk = 'Caramel Latte';
UPDATE products SET gambar = 'https://loremflickr.com/400/300/sea,beach'      WHERE nama_produk = 'Sea Breeze';

SELECT id, nama_produk, gambar FROM products;
