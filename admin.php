<?php
require 'config.php'; // Koneksi database

// Tambah buku
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['tambah_buku'])) {
    $id = $_POST['id'];
    $kategori = $_POST['kategori'];
    $nama_buku = $_POST['nama_buku'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];
    $penerbit_id = $_POST['penerbit_id'];
    
    $conn->query("INSERT INTO buku (id, kategori, nama_buku, harga, stok, penerbit_id, created_at) 
              VALUES ('$id', '$kategori', '$nama_buku', '$harga', '$stok', '$penerbit_id', NOW())");

    header("Location: admin.php");
    exit();
}

// Hapus buku
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $conn->query("DELETE FROM buku WHERE id='$id'");
    header("Location: admin.php");
    exit();
}

// Ambil data buku
$result = $conn->query("SELECT buku.*, penerbit.nama AS penerbit_nama FROM buku 
                        JOIN penerbit ON buku.penerbit_id = penerbit.id 
                        ORDER BY buku.created_at ASC"); 


// Ambil data penerbit untuk dropdown
$penerbit_result = $conn->query("SELECT * FROM penerbit");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Kelola Buku</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<nav class="navbar navbar-expand-lg navbar-dark bg-primary mb-4">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">UNIBOOKSTORE</a>
                <div class="collapse navbar-collapse">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
                        <li class="nav-item"><a class="nav-link active" href="admin.php">Admin</a></li>
                        <li class="nav-item"><a class="nav-link" href="pengadaan.php">Pengadaan</a></li>
                    </ul>
                </div>
            </div>
        </nav>
    <div class="container mt-5">
        <h1 class="text-center">Kelola Buku</h1>
        <div class="card p-3 mb-4">
            <h3>Tambah Buku</h3>
            <form method="POST">
                <div class="row">
                    <div class="col-md-2 mb-3">
                        <label class="form-label">ID Buku</label>
                        <input type="text" name="id" class="form-control" required>
                    </div>
                    <div class="col-md-2 mb-3">
                        <label class="form-label">Kategori</label>
                        <input type="text" name="kategori" class="form-control" required>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="form-label">Nama Buku</label>
                        <input type="text" name="nama_buku" class="form-control" required>
                    </div>
                    <div class="col-md-2 mb-3">
                        <label class="form-label">Harga</label>
                        <input type="number" name="harga" class="form-control" required>
                    </div>
                    <div class="col-md-2 mb-3">
                        <label class="form-label">Stok</label>
                        <input type="number" name="stok" class="form-control" required>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="form-label">Penerbit</label>
                        <div class="d-flex">
                            <select name="penerbit_id" class="form-select me-2" required>
                                <?php while ($penerbit = $penerbit_result->fetch_assoc()) { ?>
                                    <option value="<?php echo $penerbit['id']; ?>">
                                        <?php echo $penerbit['nama']; ?>
                                    </option>
                                <?php } ?>
                            </select>
                            <a href="penerbit.php" class="text">Tambah Penerbit</a>
                        </div>
                    </div>
                </div>
                <button type="submit" name="tambah_buku" class="btn btn-success">Tambah Buku</button>
            </form>
        </div>

        <h3>Daftar Buku</h3>
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>ID Buku</th>
                    <th>Kategori</th>
                    <th>Nama Buku</th>
                    <th>Harga</th>
                    <th>Stok</th>
                    <th>Penerbit</th>
                    <th>Opsi</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['kategori']; ?></td>
                    <td><?php echo $row['nama_buku']; ?></td>
                    <td><?php echo $row['harga']; ?></td>
                    <td><?php echo $row['stok']; ?></td>
                    <td><?php echo $row['penerbit_nama']; ?></td>

                    <td>
                        <a href="edit_buku.php?id=<?php echo $row['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                        <a href="admin.php?delete=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Hapus buku ini?');">Hapus</a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
