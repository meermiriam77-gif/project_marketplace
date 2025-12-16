<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
include 'db_connect.php';

$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM items WHERE user_id = '$user_id' ORDER BY date_posted DESC";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>User Dashboard</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background: url('mku fountain.jpg') no-repeat center center fixed;
      background-size: cover;
      margin: 0;
      padding: 0;
      color: #333;
    }
    .top-bar {
      background: rgba(255, 255, 255, 0.9);
      padding: 15px 25px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }
    .dashboard {
      background: rgba(255, 255, 255, 0.95);
      width: 80%;
      margin: 40px auto;
      padding: 20px 30px;
      border-radius: 15px;
      box-shadow: 0 10px 25px rgba(0,0,0,0.3);
    }
    .item {
      border-bottom: 1px solid #ddd;
      padding: 10px 0;
    }
    a { color: #667eea; text-decoration: none; }
    a.delete { color: red; }
  </style>
</head>
<body>

  <div class="top-bar">
    <h2>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?> 👋</h2>
    <div>
      <a href="post_item.php">Post Item</a> |
      <a href="items.php">View All</a> |
      <a href="logout.php">Logout</a>
    </div>
  </div>

  <div class="dashboard">
    <h3>Your Posted Items</h3>
    <?php if (mysqli_num_rows($result) > 0): ?>
      <?php while ($row = mysqli_fetch_assoc($result)): ?>
        <div class="item">
          <strong><?php echo htmlspecialchars($row['title']); ?></strong>
          <p><?php echo nl2br(htmlspecialchars($row['description'])); ?></p>
          <a href="edit_item.php?id=<?php echo $row['id']; ?>">Edit</a> |
          <a href="delete_item.php?id=<?php echo $row['id']; ?>" class="delete" onclick="return confirm('Delete this item?');">Delete</a>
        </div>
      <?php endwhile; ?>
    <?php else: ?>
      <p>No items posted yet.</p>
    <?php endif; ?>
  </div>
</body>
</html>
