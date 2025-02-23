<?php
require 'config.php'; // Koneksi ke database

// Pencarian buku
$search = "";
if (isset($_GET['search'])) {
    $search = $_GET['search'];
}

// Ambil data buku dari database
$query = "SELECT buku.id, buku.kategori, buku.nama_buku, buku.harga, buku.stok, penerbit.nama AS penerbit 
          FROM buku 
          JOIN penerbit ON buku.penerbit_id = penerbit.id 
          WHERE buku.nama_buku LIKE '%$search%'
          ORDER BY buku.id ASC";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UNIBOOKSTORE - Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<nav class="navbar navbar-expand-lg navbar-dark bg-primary mb-4">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">UNIBOOKSTORE</a>
                <div class="collapse navbar-collapse">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item"><a class="nav-link active" href="index.php">Home</a></li>
                        <li class="nav-item"><a class="nav-link" href="admin.php">Admin</a></li>
                        <li class="nav-item"><a class="nav-link" href="pengadaan.php">Pengadaan</a></li>
                    </ul>
                </div>
            </div>
        </nav>
<div class="container mt-5">
        
    <h1 class="text-center">Daftar Buku</h1>

    <!-- Form Pencarian -->
    <form method="GET" class="d-flex mb-3">
        <input type="text" name="search" class="form-control me-2" placeholder="Nama Buku..." value="<?= $search ?>">
        <button type="submit" class="btn btn-primary">Cari</button>
    </form>

    <!-- Tabel Data Buku -->
    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>ID Buku</th>
                <th>Kategori</th>
                <th>Nama Buku</th>
                <th>Harga</th>
                <th>Stok</th>
                <th>Penerbit</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()) { ?>
            <tr>
                <td><?= $row['id']; ?></td>
                <td><?= $row['kategori']; ?></td>
                <td><?= $row['nama_buku']; ?></td>
                <td>Rp<?= number_format($row['harga'], 0, ',', '.'); ?></td>
                <td><?= $row['stok']; ?></td>
                <td><?= $row['penerbit']; ?></td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
