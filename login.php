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
        <input type="checkbox" id="show-password">
        <label for="show-password">Show Password</label>

        <script>
            const passwordInput = document.getElementById('password');
            const showPasswordCheckbox = document.getElementById('show-password');

            showPasswordCheckbox.addEventListener('change',() => {
                if (showPasswordCheckbox.checked) {
                    passwordInput.type = 'text';
                } else {
                    passwordInput.type = 'password';
                }
            });
        </script>

        <br><br>
        <button type="submit">Login</button>
    </form>

    <?php
        // Connect to database
        include 'database.php';

        // Start user session
        session_start();

        // For debugging
        error_reporting(E_ALL);
        ini_set('display_errors', '1');

        // Get data
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $email = $_POST["email"];
            $password = $_POST["password"];

            // Check with database
            $email_sql = "SELECT * FROM users WHERE email = '$email'";
            $email_result = $conn -> query($email_sql);

            if ($email_result -> num_rows > 0) {
                $row = $email_result -> fetch_assoc();
                // Verify password
                if (password_verify($password, $row['password'])) {
                    // Login successful
                    header("Location: dashboard.php");
                    exit();
                } else {
                    // Incorrect password
                    echo $hashed_password;
                    echo "<br>Incorrect password. Please try again.";
                }

                // Store user information in session
                $_SESSION["logged_in"] = true;
                $_SESSION["email"] = $email;
                $_SESSION["user_id"] = $row["user_id"];
                $_SESSION["full_name"] = $row["full_name"];
                $_SESSION["role"] = $row["role"];
            } else {
                // User not found
                echo "<br>User not found. Please register.";
            }       
            // $conn -> close(); 
        }
    ?>

    <p>Don't have an account? <a href="register.php">Register</a></p>

    <!-- Quick back to home while developing -->
    <br><br><br>
    <p><a href="index.php">Home</a></p>
</body>
</html>