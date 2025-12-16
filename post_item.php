<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
include 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title']);
    $description = trim($_POST['description']);
    $user_id = $_SESSION['user_id'];

    $sql = "INSERT INTO items (user_id, title, description) VALUES ('$user_id', '$title', '$description')";
    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('✅ Item posted successfully!');</script>";
    } else {
        echo "❌ Error: " . mysqli_error($conn);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Post Item</title>
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
    button {
      background: linear-gradient(135deg, #667eea, #764ba2);
      color: white;
      border: none;
      cursor: pointer;
    }
    .top-links {
      position: absolute;
      top: 20px;
      right: 20px;
    }
    .top-links a, .top-links button {
      background: #e53e3e;
      color: white;
      padding: 8px 15px;
      border: none;
      border-radius: 6px;
      cursor: pointer;
      text-decoration: none;
      font-size: 14px;
    }
  </style>
</head>
<body>
  <div class="top-links">
    <a href="items.php">View Items</a>
    <form action="logout.php" method="post" style="display:inline;">
      <button type="submit">Logout</button>
    </form>
  </div>

  <div class="form-container">
    <h2>Post New Item</h2>
    <form method="POST">
      <input type="text" name="title" placeholder="Item Title" required>
      <textarea name="description" placeholder="Item Description" required></textarea>
      <button type="submit">Post Item</button>
    </form>
  </div>
</body>
</html>
