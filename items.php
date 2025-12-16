<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
include 'db_connect.php';
$user_id = $_SESSION['user_id'];

// Get all items (everyone's)
$result = mysqli_query($conn, "SELECT items.*, users.username FROM items JOIN users ON items.user_id = users.id ORDER BY date_posted DESC");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>View Items</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background: url('mku fountain.jpg') no-repeat center center fixed;
      background-size: cover;
      margin: 0;
      color: #333;
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
    .content {
      background: rgba(255, 255, 255, 0.9);
      margin: 80px auto;
      width: 80%;
      border-radius: 15px;
      padding: 20px;
      box-shadow: 0 10px 25px rgba(0,0,0,0.3);
    }
    .item-actions a {
      margin-right: 10px;
      color: #667eea;
      text-decoration: none;
    }
    .item-actions a.delete {
      color: red;
    }
  </style>
</head>
<body>
  <div class="top-links">
    <a href="post_item.php">Post Item</a>
    <form action="logout.php" method="post" style="display:inline;">
      <button type="submit">Logout</button>
    </form>
  </div>

  <div class="content">
    <h2>All Posted Items</h2>
    <?php while ($row = mysqli_fetch_assoc($result)): ?>
      <div>
        <h3><?php echo htmlspecialchars($row['title']); ?></h3>
        <p><?php echo nl2br(htmlspecialchars($row['description'])); ?></p>
        <p><small>Posted by: <?php echo htmlspecialchars($row['username']); ?> on <?php echo $row['date_posted']; ?></small></p>
        <?php if ($row['user_id'] == $user_id): ?>
          <div class="item-actions">
            <a href="edit_item.php?id=<?php echo $row['id']; ?>">Edit</a>
            <a href="delete_item.php?id=<?php echo $row['id']; ?>" class="delete" onclick="return confirm('Are you sure you want to delete this item?');">Delete</a>
          </div>
        <?php endif; ?>
        <hr>
      </div>
    <?php endwhile; ?>
  </div>
</body>
</html>
