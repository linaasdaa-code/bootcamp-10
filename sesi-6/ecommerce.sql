-- =====================================================
-- TUGAS SESI 6: DATABASE E-COMMERCE (Suvoire)
-- =====================================================

-- ===== 1. MEMBUAT DATABASE =====
CREATE DATABASE suvoire_db;
USE suvoire_db;

-- ===== 2. MEMBUAT TABEL =====

-- Tabel users
CREATE TABLE users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nama VARCHAR(100),
  email VARCHAR(100),
  password VARCHAR(255)
);

-- Tabel products
CREATE TABLE products (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nama_produk VARCHAR(100),
  harga INT,
  deskripsi TEXT,
  stok INT
);

-- Tabel orders (terhubung ke users dan products)
CREATE TABLE orders (
  order_id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT,
  product_id INT,
  quantity INT,
  total INT,
  FOREIGN KEY (user_id) REFERENCES users(id),
  FOREIGN KEY (product_id) REFERENCES products(id)
);

-- ===== 3. CRUD PRODUK =====

-- CREATE: menambah data produk
INSERT INTO products (nama_produk, harga, deskripsi, stok)
VALUES ('French Rose', 149000, 'Aroma mawar Prancis yang lembut.', 20);

INSERT INTO products (nama_produk, harga, deskripsi, stok) VALUES
('Vanilla Soft', 129000, 'Vanilla hangat yang nyaman.', 15),
('Osmanthus Tea', 129000, 'Teh hijau dan bunga osmanthus.', 10),
('Rose Oud', 189000, 'Mawar dan kayu oud yang mewah.', 5);

-- READ: membaca data produk
SELECT * FROM products;
SELECT nama_produk, harga FROM products;
SELECT * FROM products WHERE harga < 150000;

-- UPDATE: mengubah harga French Rose
UPDATE products SET harga = 159000 WHERE id = 1;

-- DELETE: menghapus produk Rose Oud
DELETE FROM products WHERE id = 4;

-- ===== 4. DATA CONTOH USERS DAN ORDERS =====
INSERT INTO users (nama, email, password) VALUES
('Lina', 'lina@example.com', 'rahasia123'),
('Sari', 'sari@example.com', 'rahasia456');

-- Lina membeli 2 French Rose (2 x 159.000 = 318.000)
INSERT INTO orders (user_id, product_id, quantity, total)
VALUES (1, 1, 2, 318000);