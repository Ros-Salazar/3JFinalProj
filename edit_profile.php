<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
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
        $full_name = $conn->real_escape_string($_POST['full_name']);
        $phone_number = $conn->real_escape_string($_POST['phone_number']);
        $update_query = "UPDATE users SET full_name = '$full_name', phone_number = '$phone_number' WHERE user_id = $user_id";
        $conn->query($update_query);
        header("Location: dashboard.php");
    }
    ?>
    <form method="post">
        <label>Full Name: <input type="text" name="full_name" value="<?= htmlspecialchars($user_data['full_name']) ?>"></label><br>
        <label>Phone Number: <input type="text" name="phone_number" value="<?= htmlspecialchars($user_data['phone_number']) ?>"></label><br>
        <button type="submit">Update</button>
    </form>

    <p><a href="dashboard.php">Cancel</a></p>
</body>
</html>