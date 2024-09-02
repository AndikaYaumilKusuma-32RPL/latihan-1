<?php
include 'config.php';
session_start();
if (!isset($_SESSION['nama'])) {
    header("Location: http://localhost/latihan_web_xi/login.php");
    exit;
}

$query = "SELECT pegawai.*, jabatan.nama_jabatan FROM pegawai JOIN jabatan ON pegawai.jabatan_id = jabatan.id";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Pegawai</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h1 class="mt-4">Data Pegawai</h1>
        <a href="register.php" class="btn btn-primary mb-4">Tambah Pegawai</a>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>NIK</th>
                    <th>Nama</th>
                    <th>Alamat</th>
                    <th>Jenis Kelamin</th>
                    <th>No. Telepon</th>
                    <th>Jabatan</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['nik']; ?></td>
                    <td><?php echo $row['nama']; ?></td>
                    <td><?php echo $row['alamat']; ?></td>
                    <td><?php echo $row['jenis_kelamin']; ?></td>
                    <td><?php echo $row['no_tlp']; ?></td>
                    <td><?php echo $row['nama_jabatan']; ?></td>
                    <td>
                        <a href="edit.php?id=<?php echo $row['id']; ?>" class="btn btn-warning">Edit</a>
                        <a href="delete.php?id=<?php echo $row['id']; ?>" class="btn btn-danger">Delete</a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>
</html>
