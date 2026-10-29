CREATE DATABASE IF NOT EXISTS db_inventaris_gudang
  CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE db_inventaris_gudang;

DROP TABLE IF EXISTS barang;
DROP TABLE IF EXISTS users;

CREATE TABLE users (
                       id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                       username VARCHAR(50) NOT NULL UNIQUE,
                       password VARCHAR(255) NOT NULL,
                       nama_lengkap VARCHAR(100) NOT NULL,
                       created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

CREATE TABLE barang (
                        id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                        kode_barang VARCHAR(20) NOT NULL UNIQUE,
                        nama_barang VARCHAR(100) NOT NULL,
                        kategori VARCHAR(30) NOT NULL,
                        jumlah INT UNSIGNED NOT NULL DEFAULT 0,
                        satuan VARCHAR(20) NOT NULL,
                        harga DECIMAL(15,2) NOT NULL DEFAULT 0,
                        lokasi_rak VARCHAR(30) DEFAULT NULL,
                        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB;

INSERT INTO users (username, password, nama_lengkap) VALUES
('admin', 'admin123', 'Administrator Gudang');

INSERT INTO barang (kode_barang, nama_barang, kategori, jumlah, satuan, harga, lokasi_rak) VALUES
('BRG-001', 'Kardus Ukuran Besar', 'kemasan', 120, 'pcs', 4500.00, 'A-01'),
('BRG-002', 'Lakban Bening 48mm', 'kemasan', 8, 'pcs', 12000.00, 'A-02'),
('BRG-003', 'Kabel USB Type-C', 'elektronik', 45, 'pcs', 35000.00, 'B-01'),
('BRG-004', 'Beras Premium 5kg', 'makanan', 30, 'box', 68000.00, 'C-03'),
('BRG-005', 'Cairan Pembersih Lantai', 'kebersihan', 5, 'liter', 22000.00, 'D-01');