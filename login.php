<?php
session_start();
include 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // Fetch user from DB
    $sql = "SELECT id, username, password FROM users WHERE username = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);

        if (password_verify($password, $row['password'])) {

            // SAVE SESSION ONLY
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['username'] = $row['username'];

            // Redirect to dashboard
            header("Location: dashboard.php");
            exit();

        } else {
            // Redirect back to login with error
            header("Location: login.php?error=wrong_password");
            exit();
        }

    } else {
        // Redirect back to login with error
        header("Location: login.php?error=user_not_found");
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Login</title>
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
      width: 350px;
      text-align: center;
    }
    input, button {
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
    .error {
      color: red;
    }
  </style>
</head>
<body>
  <div class="form-container">
    <h2>Login</h2>
    <?php
      if (isset($_GET['error'])) {
          if ($_GET['error'] === 'wrong_password') {
              echo "<p class='error'>❌ Wrong password. Try again.</p>";
          } elseif ($_GET['error'] === 'user_not_found') {
              echo "<p class='error'>❌ User not found. Register first.</p>";
          } elseif ($_GET['error'] === 'logged_out') {
              echo "<p class='error'>✅ You have been logged out.</p>";
          }
      } elseif (isset($_GET['success']) && $_GET['success'] === 'registered') {
          echo "<p style='color:green;'>✅ Registration successful. You can now log in.</p>";
      }
    ?>
    <form method="POST">
      <input type="text" name="username" placeholder="Username" required>
      <input type="password" name="password" placeholder="Password" required>
      <button type="submit">Login</button>
    </form>
    <p>Don't have an account? <a href="register.php">Register</a></p>
  </div>
</body>
</html>



