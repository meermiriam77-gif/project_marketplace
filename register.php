<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $firstname = trim($_POST['firstname']);
    $lastname  = trim($_POST['lastname']);
    $email     = trim($_POST['email']);
    $phone     = trim($_POST['phone']);
    $username  = trim($_POST['username']);
    $password  = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Check if username or email already exists
    $check_sql = "SELECT id FROM users WHERE username = ? OR email = ?";
    $stmt = mysqli_prepare($conn, $check_sql);
    mysqli_stmt_bind_param($stmt, "ss", $username, $email);
    mysqli_stmt_execute($stmt);
    $check_result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($check_result) > 0) {
        // Redirect with error
        header("Location: register.php?error=exists");
        exit();
    }

    // Insert new user
    $insert_sql = "INSERT INTO users (firstname, lastname, email, phone, username, password) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $insert_sql);
    mysqli_stmt_bind_param($stmt, "ssssss", $firstname, $lastname, $email, $phone, $username, $password);

    if (mysqli_stmt_execute($stmt)) {
        // Redirect to login page after successful registration
        header("Location: login.php?success=registered");
        exit();
    } else {
        header("Location: register.php?error=failed");
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Register</title>
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
  </style>
</head>
<body>
  <div class="form-container">
    <h2>Create Account</h2>
    <?php
      if (isset($_GET['error'])) {
          if ($_GET['error'] == 'exists') {
              echo "<p style='color:red;'>Username or email already exists!</p>";
          } elseif ($_GET['error'] == 'failed') {
              echo "<p style='color:red;'>Registration failed. Try again.</p>";
          }
      }
    ?>
    <form method="POST">
      <input type="text" name="firstname" placeholder="First Name" required>
      <input type="text" name="lastname" placeholder="Last Name" required>
      <input type="email" name="email" placeholder="Email" required>
      <input type="text" name="phone" placeholder="Phone Number" required>
      <input type="text" name="username" placeholder="Username" required>
      <input type="password" name="password" placeholder="Password" required>
      <button type="submit">Register</button>
    </form>
    <p>Already have an account? <a href="login.php">Login</a></p>
  </div>
</body>
</html>
