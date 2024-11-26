<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <h2>Login</h2>
    <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
        <br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
        <br>
        <button type="submit">Login</button>
    </form>

    <?php
        // Connect to database
        include 'database.php';

        // For debugging
        error_reporting(E_ALL);
        ini_set('display_errors', '1');

        // Get data
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $email = $_POST["email"];
            $password = $_POST["password"];

            // Hash the password
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            // Check with database
            $email_sql = "SELECT * FROM users WHERE email = '$email'";
            $email_result = $conn -> query($email_sql);

            if ($email_result -> num_rows > 0) {
                $row = $result -> fetch_assoc();
                // Verify password
                if (password_verify($password, $row['password'])) {
                    // Login successful
                    header("Location: dashboard.php");
                    exit();
                } else {
                    // Incorrect password
                    echo "Incorrect password. Please try again.";
                }
            } else {
                // User not found
                echo "";
                echo "User not found. Please register.";
            }       
            $conn -> close(); 
        }
    ?>

    <p>Don't have an account? <a href="register.php">Register</a></p>
</body>
</html>