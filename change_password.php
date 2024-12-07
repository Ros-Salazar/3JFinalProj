<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password</title>
</head>
<body>
    <?php
    // Connect to database
    include 'database.php';

    // For debugging
    error_reporting(E_ALL);
    ini_set('display_errors', '1');

    // Start user session
    session_start();

    // Get logged-in user's data
    $user_id = $_SESSION['user_id'];
    $user_query = "SELECT * FROM users WHERE user_id = $user_id";
    $user_result = $conn->query($user_query);
    $user_data = $user_result->fetch_assoc();

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $current_password = $_POST['current_password'];
        $new_password = password_hash($_POST['new_password'], PASSWORD_DEFAULT);

        $user_query = "SELECT password FROM users WHERE user_id = $user_id";
        $user_result = $conn->query($user_query);
        $user = $user_result->fetch_assoc();

        if (password_verify($current_password, $user['password'])) {
            $update_query = "UPDATE users SET password = '$new_password' WHERE user_id = $user_id";
            $conn->query($update_query);
            echo "Password updated.";
        } else {
            echo "Current password is incorrect.";
        }
    }
    ?>
    <form method="post">
        <label>Current Password: <input type="password" name="current_password" required></label><br>
        <label>New Password: <input type="password" name="new_password" required></label><br>
        <button type="submit">Change Password</button>
    </form>

    <p><a href="dashboard.php">Cancel</a></p>

</body>
</html>