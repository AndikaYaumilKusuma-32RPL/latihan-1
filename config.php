<?php
// Database connection
$conn = mysqli_connect("localhost", "root", "", "latihan_web_xi");

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
