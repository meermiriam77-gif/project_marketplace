<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
include 'db_connect.php';
$user_id = $_SESSION['user_id'];
$id = intval($_GET['id']);

// Fetch item
$result = mysqli_query($conn, "SELECT * FROM items WHERE id='$id' AND user_id='$user_id'");
$item = mysqli_fetch_assoc($result);
if (!$item) {
    echo "<script>alert('❌ You cannot edit this item.'); window.location='items.php';</script>";
    exit();
}

// Update item
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title']);
    $description = trim($_POST['description']);
    $update_sql = "UPDATE items SET title='$title', description='$description' WHERE id='$id' AND user_id='$user_id'";
    if (mysqli_query($conn, $update_sql)) {
        echo "<script>alert('✅ Item updated successfully!'); window.location='items.php';</script>";
    } else {
        echo "❌ Error updating: " . mysqli_error($conn);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Edit Item</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background: url('mku fountain.jpg') no-repeat center center fixed;
      background-size: cover;
      height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      margin: 0;
    }
    .form-container {
      background: rgba(255, 255, 255, 0.9);
      padding: 30px 40px;
      border-radius: 15px;
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.3);
      width: 400px;
      text-align: center;
    }
    textarea, input, button {
      width: 100%;
      padding: 12px;
      margin: 8px 0;
      border: 1px solid #ccc;
      border-radius: 8px;
    }
  </style>
</head>
<body>
  <div class="form-container">
    <h2>Edit Item</h2>
    <form method="POST">
      <input type="text" name="title" value="<?php echo htmlspecialchars($item['title']); ?>" required>
      <textarea name="description" required><?php echo htmlspecialchars($item['description']); ?></textarea>
      <button type="submit">Update Item</button>
    </form>
  </div>
</body>
</html>
