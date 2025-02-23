CREATE DATABASE IF NOT EXISTS unibookstore;
USE unibookstore;

CREATE TABLE penerbit (
    id VARCHAR(20) PRIMARY KEY,  -- ID Penerbit bisa berisi huruf dan angka
    nama VARCHAR(255) NOT NULL,
    alamat TEXT NOT NULL,
    kota VARCHAR(100) NOT NULL,
    telepon VARCHAR(20) NOT NULL
);

-- Buat tabel buku
CREATE TABLE buku (
    id VARCHAR(20) PRIMARY KEY,  -- ID Buku bisa berisi huruf dan angka
    kategori VARCHAR(255) NOT NULL,
    nama_buku VARCHAR(255) NOT NULL,
    harga INT NOT NULL,
    stok INT NOT NULL,
    penerbit_id VARCHAR(20) NOT NULL,
    FOREIGN KEY (penerbit_id) REFERENCES penerbit(id) ON DELETE CASCADE
);

