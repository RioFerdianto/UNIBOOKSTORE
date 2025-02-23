<?php
require 'config.php'; // Koneksi ke database

// Cek apakah ada ID yang dikirim untuk diedit
if (!isset($_GET['id'])) {
    header("Location: penerbit.php");
    exit();
}

$id = $_GET['id'];

// Ambil data penerbit berdasarkan ID
$result = $conn->query("SELECT * FROM penerbit WHERE id = '$id'");
if ($result->num_rows == 0) {
    header("Location: penerbit.php");
    exit();
}
$penerbit = $result->fetch_assoc();

// Proses update penerbit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $new_id = $_POST['id'];
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $kota = $_POST['kota'];
    $telepon = $_POST['telepon'];

    // Update data penerbit termasuk ID baru
    $conn->query("UPDATE penerbit SET 
                    id = '$new_id',
                    nama = '$nama',
                    alamat = '$alamat',
                    kota = '$kota',
                    telepon = '$telepon'
                  WHERE id = '$id'");

    // Redirect kembali ke halaman penerbit
    header("Location: penerbit.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Penerbit</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <h1 class="text-center">Edit Penerbit</h1>
        <a href="penerbit.php" class="btn btn-secondary mb-3">Kembali</a>

        <div class="card p-4">
            <form method="POST">
                <div class="mb-3">
                    <label class="form-label">ID Penerbit</label>
                    <input type="text" name="id" class="form-control" value="<?= $penerbit['id'] ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Nama</label>
                    <input type="text" name="nama" class="form-control" value="<?= $penerbit['nama'] ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Alamat</label>
                    <input type="text" name="alamat" class="form-control" value="<?= $penerbit['alamat'] ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Kota</label>
                    <input type="text" name="kota" class="form-control" value="<?= $penerbit['kota'] ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Telepon</label>
                    <input type="text" name="telepon" class="form-control" value="<?= $penerbit['telepon'] ?>" required>
                </div>
                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
