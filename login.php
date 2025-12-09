<?php
include 'includes/db.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM USERS WHERE EMAIL='$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['PASSWORD'])) {
            $_SESSION['user_id'] = $user['USER_ID'];
            header("Location: index.php");
        } else {
            echo '<div class="success-message">Invalid credentials</div>';
        }
    } else {
        echo '<div class="success-message">No user found</div>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<style>
    .success-message {
      margin: 20px auto;
      padding: 15px 20px;
      max-width: 400px;
      text-align: center;
      background-color: #e6ffea;
      color: #006600;
      border: 1px solid #006600;
      border-radius: 4px;
      font-size: 1.1em;
    }
 </style>
<body>
    <!-- Navigation Bar -->
    <div class="navbar">
        <a href="index.php" class="logo">MOVIE RECOMMENDATION</a>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="login.php">Login</a></li>
                <li><a href="register.php">Register</a></li>
            </ul>
        </nav>
    </div>

    <!-- Login Form -->
    <div class="container">
        <h1 class="main-heading">Login</h1>
        <div class="shelter-card">
            <form method="POST" action="">
                <input type="email" name="email" required placeholder="Email">
                <input type="password" name="password" required placeholder="Password">
                <input type="submit" value="Login" class="button">
            </form>
        </div>
    </div>

    <!-- Footer -->
    <footer>
        <p>&copy;2025 Movie Recommendation. All rights reserved.</p>
    </footer>
</body>
</html>
