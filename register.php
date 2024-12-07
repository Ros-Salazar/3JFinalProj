<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
</head>
<body>
    <h2>Register</h2>
    <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
        <label for="full_name">Full Name:</label>
        <input type="text" id="full_name" name="full_name" required>
        <br>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
        <br>
        <label for="phone_number">Phone Number:</label>
        <input type="tel" id="phone_number" name="phone_number" required>
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
        <button type="submit">Register</button>
    </form>

    <?php
        // Connect to database
        include 'database.php';

        // For debugging
        error_reporting(E_ALL);
        ini_set('display_errors', '1');

        // Get data
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $full_name = $_POST["full_name"];
            $email = $_POST["email"];
            $phone_number = $_POST["phone_number"];
            $password = $_POST["password"];

            // Hash the password
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            // Check with database
            $check_sql = "SELECT * FROM users WHERE email = '$email'";
            $check_result = $conn -> query($check_sql);

            if ($check_result -> num_rows > 0) {
                echo "User already exists. Please login instead.";
            } else {
                // Insert the user into the database
                $register_sql = "INSERT INTO users (full_name, email, phone_number, password, role, created_at) 
                VALUES ('$full_name', '$email', '$phone_number', '$hashed_password', 'customer', NOW())";
                $register_result = $conn -> query($register_sql);
                
                if ($register_result) {
                    // Registration successful
                    echo "";
                    echo "Registration successful";
                    header("Location: login.php");
                    exit();
                } else {
                    // Registration failed
                    echo "";
                    echo "Registration failed. Please try again.";
                }
            }

            // $conn -> close();
        }
    ?>

    <p>Already have an account? <a href="login.php">Login</a></p>

    <!-- Quick back to home while developing -->
    <br><br><br>
    <p><a href="index.php">Home</a></p>
</body>
</html>