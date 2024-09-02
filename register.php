<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nik = $_POST['nik'];
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $alamat = $_POST['alamat'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $no_tlp = $_POST['no_tlp'];
    $jabatan_id = $_POST['jabatan_id'];

    $sql = "INSERT INTO pegawai (nik, nama, email, password, alamat, jenis_kelamin, no_tlp, jabatan_id) VALUES ('$nik', '$nama', '$email', '$password', '$alamat', '$jenis_kelamin', '$no_tlp', '$jabatan_id')";
    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Data pegawai berhasil ditambahkan'); window.location='index.php';</script>";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

// Fetch jabatan data for dropdown
$jabatan_result = mysqli_query($conn, "SELECT * FROM jabatan");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Pegawai</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        /* Copy and paste the CSS from your template here */
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
        .login-container input[type="text"], .login-container input[type="password"], .login-container input[type="email"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: none;
            border-radius: 5px;
            background: rgba(255, 255, 255, 0.2);
            color: white;
        }
        .login-container input[type="text"]::placeholder, .login-container input[type="password"]::placeholder, .login-container input[type="email"]::placeholder {
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
        .login-container .options {
            display: flex;
            justify-content: space-between;
            align-items: center;
            color: white;
            margin: 10px 0;
        }
        .login-container .options a {
            color: white;
            text-decoration: none;
        }
        .login-container .social-login {
            margin-top: 20px;
        }
        .login-container .social-login button {
            width: 45%;
            padding: 10px;
            border: none;
            border-radius: 5px;
            background: white;
            color: black;
            font-size: 14px;
            cursor: pointer;
            margin: 5px;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h1>Register Pegawai</h1>
        <p>Isi data pegawai</p>
        <form method="POST" action="">
            <input type="text" name="nik" placeholder="NIK" required>
            <input type="text" name="nama" placeholder="Nama" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <input type="text" name="alamat" placeholder="Alamat" required>
            <select name="jenis_kelamin" class="form-control" required>
                <option value="Laki-laki">Laki-laki</option>
                <option value="Perempuan">Perempuan</option>
            </select>
            <input type="text" name="no_tlp" placeholder="No. Telepon" required>
            <select name="jabatan_id" class="form-control" required>
                <?php while ($row = mysqli_fetch_assoc($jabatan_result)) { ?>
                    <option value="<?php echo $row['id']; ?>"><?php echo $row['nama_jabatan']; ?></option>
                <?php } ?>
            </select>
            <button type="submit">Register</button>
        </form>
        <div class="options">
            <a href="login.php">Already have an account? Sign In</a>
        </div>
    </div>
</body>
</html>
