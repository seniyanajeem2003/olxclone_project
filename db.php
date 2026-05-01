<?php
$host = "localhost";
$user = "root";
$pass = ""; // Default XAMPP password is empty
$dbname = "olx_db";

// Establishing the connection
$conn = mysqli_connect($host, $user, $pass, $dbname);

// Checking if the connection works
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>