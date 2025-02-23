<?php
require 'config.php'; // Koneksi database

// Tambah penerbit
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['tambah_penerbit'])) {
    $id = $_POST['id']; // Tambah ID Penerbit
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $kota = $_POST['kota'];
    $telepon = $_POST['telepon'];
    
    $conn->query("INSERT INTO penerbit (id, nama, alamat, kota, telepon) VALUES ('$id', '$nama', '$alamat', '$kota', '$telepon')");
    header("Location: penerbit.php");
    exit();
}

// Hapus penerbit
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $conn->query("DELETE FROM penerbit WHERE id='$id'");
    header("Location: penerbit.php");
    exit();
}

// Ambil data penerbit
$result = $conn->query("SELECT * FROM penerbit");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Penerbit</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <h1 class="text-center">Kelola Penerbit</h1>
        <a href="admin.php" class="btn btn-secondary mb-3">Kembali</a>
        
        <div class="card p-3 mb-4">
            <h3>Tambah Penerbit</h3>
            <form method="POST">
                <div class="row">
                    <div class="col-md-2 mb-3">
                        <label class="form-label">ID Penerbit</label>
                        <input type="text" name="id" class="form-control" required>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="form-label">Nama</label>
                        <input type="text" name="nama" class="form-control" required>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="form-label">Alamat</label>
                        <input type="text" name="alamat" class="form-control" required>
                    </div>
                    <div class="col-md-2 mb-3">
                        <label class="form-label">Kota</label>
                        <input type="text" name="kota" class="form-control" required>
                    </div>
                    <div class="col-md-2 mb-3">
                        <label class="form-label">Telepon</label>
                        <input type="text" name="telepon" class="form-control" required>
                    </div>
                </div>
                <button type="submit" name="tambah_penerbit" class="btn btn-primary">Tambah Penerbit</button>
            </form>
        </div>

        <h3>Daftar Penerbit</h3>
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>Alamat</th>
                    <th>Kota</th>
                    <th>Telepon</th>
                    <th>Opsi</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['nama']; ?></td>
                    <td><?php echo $row['alamat']; ?></td>
                    <td><?php echo $row['kota']; ?></td>
                    <td><?php echo $row['telepon']; ?></td>
                    <td>
                        <a href="edit_penerbit.php?id=<?php echo $row['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                        <a href="penerbit.php?delete=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Hapus penerbit ini?');">Hapus</a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
