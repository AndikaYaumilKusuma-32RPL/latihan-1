<?php
include 'config.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama_jabatan = $_POST['nama_jabatan'];
    $gaji_pokok = $_POST['gaji_pokok'];
    $tunjangan = $_POST['tunjangan'];

    $sql = "INSERT INTO jabatan (nama_jabatan, gaji_pokok, tunjangan) VALUES ('$nama_jabatan', '$gaji_pokok', '$tunjangan')";
    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Jabatan berhasil ditambahkan'); window.location='list_jabatan.php';</script>";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Jabatan</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        body, html {
            height: 100%;
            margin: 0;
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            background: url('https://c.wallhere.com/photos/8f/2d/nature_landscape_pixel_art_pixelated_pixels_mountains_Wavestormed_trees-1523665.jpg!s1') no-repeat center center fixed;
            background-size: cover;
        }
        .login-container {
            background: rgba(255, 255, 255, 0.1);
            padding: 20px;
            border-radius: 10px;
            text-align: center;
            width: 300px;
        }
        .login-container h1 {
            color: white;
            font-size: 24px;
            margin-bottom: 10px;
        }
        .login-container p {
            color: white;
            margin-bottom: 20px;
        }
        .login-container input[type="text"], .login-container input[type="number"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: none;
            border-radius: 5px;
            background: rgba(255, 255, 255, 0.2);
            color: white;
        }
        .login-container input[type="text"]::placeholder, .login-container input[type="number"]::placeholder {
            color: white;
        }
        .login-container button {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 5px;
            background: #ffb6b9;
            color: white;
            font-size: 16px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h1>Tambah Jabatan</h1>
        <form method="POST" action="">
            <input type="text" name="nama_jabatan" placeholder="Nama Jabatan" required>
            <input type="number" name="gaji_pokok" placeholder="Gaji Pokok" required>
            <input type="number" name="tunjangan" placeholder="Tunjangan" required>
            <button type="submit">Tambah Jabatan</button>
        </form>
    </div>
</body>
</html>
