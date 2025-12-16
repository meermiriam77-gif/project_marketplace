<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$host = "localhost";
$user = "root";
$pass = "";
$dbname = "victor"; 

$conn = mysqli_connect($host, $user, $pass, $dbname);

if (!$conn) {
    die("❌ Database connection failed: " . mysqli_connect_error());
}
?>
