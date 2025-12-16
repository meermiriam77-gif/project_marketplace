<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
include 'db_connect.php';
$user_id = $_SESSION['user_id'];
$id = intval($_GET['id']);

// Delete only if user owns it
$sql = "DELETE FROM items WHERE id='$id' AND user_id='$user_id'";
if (mysqli_query($conn, $sql)) {
    echo "<script>alert('✅ Item deleted successfully!'); window.location='items.php';</script>";
} else {
    echo "❌ Error deleting: " . mysqli_error($conn);
}
?>
