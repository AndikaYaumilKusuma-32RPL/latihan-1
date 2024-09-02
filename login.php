<?php
include 'config.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM pegawai WHERE email='$email'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        if (password_verify($password, $row['password'])) {
            $_SESSION['username'] = $row['nama'];
            header("Location: index.php");
        } else {
            echo "<script>alert('Invalid password');</script>";
        }
    } else {
        echo "<script>alert('No user found');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Pegawai</title>
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
    </style>
</head>
<body>
    <div class="login-container">
        <h1>Login Pegawai</h1>
        <p>Have an account?</p>
        <form method="POST" action="">
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">SIGN IN</button>
            <div class="options">
                <label><input type="checkbox"> Remember Me</label>
                <a href="#">Forgot Password</a>
            </div>
        </form>
    </div>
</body>
</html>
