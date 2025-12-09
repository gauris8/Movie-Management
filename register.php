<?php
include 'includes/db.php';
// session_start(); // Session start is not needed for registration itself

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Variable to store potential error message
$error_message = '';
$name = $email = ''; // Initialize variables to prevent undefined warnings

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // 1. Retrieve POST data
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password_input = $_POST['password'];

    // 2. CHECK FOR EXISTING USER (Checking only the EMAIL column)
    // We now only check where EMAIL = ?
    $check_stmt = $conn->prepare("SELECT COUNT(*) FROM USERS WHERE EMAIL = ?");
    if ($check_stmt) {
        $check_stmt->bind_param("s", $email); // Only one 's' parameter for email
        $check_stmt->execute();
        $check_stmt->bind_result($count);
        $check_stmt->fetch();
        $check_stmt->close();

        if ($count > 0) {
            // A user with this email already exists
            $error_message = "Registration failed: An account with this **email address** already exists. Please use a different email.";
        } else {
            // 3. PROCEED WITH REGISTRATION (No duplicate email found)
            $password_hashed = password_hash($password_input, PASSWORD_DEFAULT);
            
            $insert_stmt = $conn->prepare("INSERT INTO USERS (NAME, EMAIL, PASSWORD) VALUES (?, ?, ?)");
            
            if ($insert_stmt) {
                $insert_stmt->bind_param("sss", $name, $email, $password_hashed);
                
                if ($insert_stmt->execute()) {
                    // Registration successful
                    $name = $email = ''; 
                    echo '<div class="success-message">Registration successful! You can now <a href="login.php">Login</a>.</div>';
                } else {
                    $error_message = "Database Error: Could not create user.";
                }
                $insert_stmt->close();
            } else {
                $error_message = "Database Error: Could not prepare insert statement.";
            }
        }
    } else {
        $error_message = "Database Error: Could not prepare check statement.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="css/styles.css">
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

        .error-message {
            margin: 20px auto;
            padding: 15px 20px;
            max-width: 400px;
            text-align: center;
            background-color: #ffcccc; 
            color: #cc0000;          
            border: 1px solid #cc0000;
            border-radius: 4px;
            font-size: 1.1em;
        }
    </style>
</head>
<body>
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

    <div class="container">
        <h1 class="main-heading">Register</h1>
        
        <?php if (!empty($error_message)): ?>
            <div class="error-message"><?php echo $error_message; ?></div>
        <?php endif; ?>

        <div class="shelter-card">
            <form method="POST" action="">
                <input type="text" name="name" required placeholder="Name" value="<?php echo htmlspecialchars($name); ?>">
                
                <input type="email" name="email" required placeholder="Email" value="<?php echo htmlspecialchars($email); ?>">
                <input type="password" name="password" required placeholder="Password">
                <input type="submit" value="Register" class="button">
            </form>
        </div>
    </div>

    <footer>
        <p>&copy; 2025 Movie Recommendation. All rights reserved.</p>
    </footer>
</body>
</html>