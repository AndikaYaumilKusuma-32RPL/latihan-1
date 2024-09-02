<?php
include 'config.php';
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

// Proses untuk menambahkan atau mengedit jabatan
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama_jabatan = $_POST['nama_jabatan'];
    $gaji_pokok = $_POST['gaji_pokok'];
    $tunjangan = $_POST['tunjangan'];

    if (isset($_POST['jabatan_id'])) {
        // Update jabatan yang sudah ada
        $jabatan_id = $_POST['jabatan_id'];
        $sql = "UPDATE jabatan SET nama_jabatan='$nama_jabatan', gaji_pokok='$gaji_pokok', tunjangan='$tunjangan' WHERE id=$jabatan_id";
        if (mysqli_query($conn, $sql)) {
            echo "<script>alert('Jabatan berhasil diperbarui'); window.location='list_jabatan.php';</script>";
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    } else {
        // Tambah jabatan baru
        $sql = "INSERT INTO jabatan (nama_jabatan, gaji_pokok, tunjangan) VALUES ('$nama_jabatan', '$gaji_pokok', '$tunjangan')";
        if (mysqli_query($conn, $sql)) {
            echo "<script>alert('Jabatan berhasil ditambahkan'); window.location='list_jabatan.php';</script>";
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    }
}

// Proses untuk menghapus jabatan
if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    $sql = "DELETE FROM jabatan WHERE id=$delete_id";
    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Jabatan berhasil dihapus'); window.location='list_jabatan.php';</script>";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

// Fetch semua data jabatan
$query = "SELECT * FROM jabatan";
$result = mysqli_query($conn, $query);

$edit_jabatan = null;
if (isset($_GET['edit_id'])) {
    $edit_id = $_GET['edit_id'];
    $edit_query = "SELECT * FROM jabatan WHERE id=$edit_id";
    $edit_result = mysqli_query($conn, $edit_query);
    $edit_jabatan = mysqli_fetch_assoc($edit_result);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Jabatan</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h1 class="mt-4">Daftar Jabatan</h1>

        <!-- Form untuk tambah/edit jabatan -->
        <div class="card mb-4">
            <div class="card-header">
                <?php echo $edit_jabatan ? "Edit Jabatan" : "Tambah Jabatan"; ?>
            </div>
            <div class="card-body">
                <form method="POST" action="">
                    <?php if ($edit_jabatan): ?>
                        <input type="hidden" name="jabatan_id" value="<?php echo $edit_jabatan['id']; ?>">
                    <?php endif; ?>
                    <div class="form-group">
                        <label>Nama Jabatan</label>
                        <input type="text" name="nama_jabatan" class="form-control" value="<?php echo $edit_jabatan['nama_jabatan'] ?? ''; ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Gaji Pokok</label>
                        <input type="number" name="gaji_pokok" class="form-control" value="<?php echo $edit_jabatan['gaji_pokok'] ?? ''; ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Tunjangan</label>
                        <input type="number" name="tunjangan" class="form-control" value="<?php echo $edit_jabatan['tunjangan'] ?? ''; ?>" required>
                    </div>
                    <button type="submit" class="btn btn-primary">
                        <?php echo $edit_jabatan ? "Update Jabatan" : "Tambah Jabatan"; ?>
                    </button>
                </form>
            </div>
        </div>

        <!-- Tabel untuk menampilkan data jabatan -->
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama Jabatan</th>
                    <th>Gaji Pokok</th>
                    <th>Tunjangan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['nama_jabatan']; ?></td>
                    <td><?php echo $row['gaji_pokok']; ?></td>
                    <td><?php echo $row['tunjangan']; ?></td>
                    <td>
                        <a href="list_jabatan.php?edit_id=<?php echo $row['id']; ?>" class="btn btn-warning">Edit</a>
                        <a href="list_jabatan.php?delete_id=<?php echo $row['id']; ?>" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus jabatan ini?');">Hapus</a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>
</html>
