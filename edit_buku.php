<?php
require 'config.php'; // Koneksi ke database

// Ambil ID buku dari URL
if (!isset($_GET['id'])) {
    header("Location: admin.php");
    exit();
}

$id = $_GET['id'];

// Ambil data buku berdasarkan ID
$result = $conn->query("SELECT * FROM buku WHERE id = '$id'");
if ($result->num_rows == 0) {
    header("Location: admin.php");
    exit();
}

$buku = $result->fetch_assoc();

// Proses update data buku
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_baru = $_POST['id']; // Bisa diedit dengan huruf/angka
    $kategori = $_POST['kategori'];
    $nama_buku = $_POST['nama_buku'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];
    $penerbit_id = $_POST['penerbit_id'];

    $conn->query("UPDATE buku SET 
        id = '$id_baru',
        kategori = '$kategori', 
        nama_buku = '$nama_buku', 
        harga = '$harga', 
        stok = '$stok', 
        penerbit_id = '$penerbit_id' 
        WHERE id = '$id'");

    header("Location: admin.php");
    exit();
}

// Ambil data penerbit untuk dropdown
$penerbit_result = $conn->query("SELECT * FROM penerbit");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Buku</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <h1 class="text-center">Edit Buku</h1>
        <a href="admin.php" class="btn btn-secondary mb-3">Kembali</a>

        <div class="card p-3">
            <form method="POST">
                <div class="row">
                    <div class="col-md-2 mb-3">
                        <label class="form-label">ID Buku</label>
                        <input type="text" name="id" class="form-control" value="<?php echo $buku['id']; ?>" required>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="form-label">Kategori</label>
                        <input type="text" name="kategori" class="form-control" value="<?php echo $buku['kategori']; ?>" required>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="form-label">Nama Buku</label>
                        <input type="text" name="nama_buku" class="form-control" value="<?php echo $buku['nama_buku']; ?>" required>
                    </div>
                    <div class="col-md-2 mb-3">
                        <label class="form-label">Harga</label>
                        <input type="number" name="harga" class="form-control" value="<?php echo $buku['harga']; ?>" required>
                    </div>
                    <div class="col-md-2 mb-3">
                        <label class="form-label">Stok</label>
                        <input type="number" name="stok" class="form-control" value="<?php echo $buku['stok']; ?>" required>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Penerbit</label>
                        <select name="penerbit_id" class="form-control" required>
                            <?php while ($penerbit = $penerbit_result->fetch_assoc()) { ?>
                                <option value="<?php echo $penerbit['id']; ?>" <?php if ($buku['penerbit_id'] == $penerbit['id']) echo "selected"; ?>>
                                    <?php echo $penerbit['id'] . " - " . $penerbit['nama']; ?>
                                </option>
                            <?php } ?>
                        </select>
                        <a href="penerbit.php" class="btn btn-link">Tambah Penerbit</a>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
