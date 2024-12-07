<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>
<body>
    <!-- user dashboard.php -->
    <?php
    // Connect to database
    include 'database.php';

    // For debugging
    error_reporting(E_ALL);
    ini_set('display_errors', '1');

    // Start user session
    session_start();

    // Check if user is logged in
    if (!isset($_SESSION['user_id'])) {
        header("Location: login.php");
        exit();
    }

    // Get logged-in user's data
    $user_id = $_SESSION['user_id'];
    $user_query = "SELECT * FROM users WHERE user_id = $user_id";
    $user_result = $conn->query($user_query);
    $user_data = $user_result->fetch_assoc();

    // Upcoming Appointments
    $upcoming_query = "
        SELECT a.*, s.service_name 
        FROM appointments a
        JOIN services s ON a.service_id = s.service_id
        WHERE a.user_id = $user_id AND a.status IN ('pending', 'confirmed') AND a.appointment_date >= CURDATE()
        ORDER BY a.appointment_date, a.start_time";
    $upcoming_result = $conn->query($upcoming_query);

    // Past Appointments
    $past_query = "
        SELECT a.*, s.service_name 
        FROM appointments a
        JOIN services s ON a.service_id = s.service_id
        WHERE a.user_id = $user_id AND a.status = 'completed'
        ORDER BY a.appointment_date DESC";
    $past_result = $conn->query($past_query);

    // Promotions
    $promotions_query = "
    SELECT * FROM promotions 
    WHERE start_date <= CURDATE() AND end_date >= CURDATE()";
    $promotions_result = $conn->query($promotions_query);
    ?>

    <!-- Greet user -->
    <h1>Welcome, <?= htmlspecialchars($user_data['full_name']) ?>!</h1>

    <!-- Upcoming Appointments -->
    <h2>Upcoming Appointments</h2>
    <?php if ($upcoming_result->num_rows > 0): ?>
        <ul>
            <?php while ($row = $upcoming_result->fetch_assoc()): ?>
                <li>
                    <strong><?= htmlspecialchars($row['service_name']) ?></strong><br>
                    Date: <?= htmlspecialchars($row['appointment_date']) ?><br>
                    Time: <?= htmlspecialchars($row['start_time']) ?> - <?= htmlspecialchars($row['end_time']) ?><br>
                    Status: <?= htmlspecialchars($row['status']) ?><br>
                    <a href="cancel.php?appointment_id=<?= $row['appointment_id'] ?>">Cancel</a> | 
                    <a href="reschedule.php?appointment_id=<?= $row['appointment_id'] ?>">Reschedule</a>
                </li>
            <?php endwhile; ?>
        </ul>
    <?php else: ?>
        <p>No upcoming appointments.</p>
    <?php endif; ?>

    <!-- Past Appointments -->
    <h2>Past Appointments</h2>
    <?php if ($past_result->num_rows > 0): ?>
        <ul>
            <?php while ($row = $past_result->fetch_assoc()): ?>
                <li>
                    <strong><?= htmlspecialchars($row['service_name']) ?></strong><br>
                    Date: <?= htmlspecialchars($row['appointment_date']) ?><br>
                    <a href="review.php?appointment_id=<?= $row['appointment_id'] ?>">Leave a Review</a>
                </li>
            <?php endwhile; ?>
        </ul>
    <?php else: ?>
        <p>No past appointments.</p>
    <?php endif; ?>

    <!-- Promotions and Rewards -->
    <h2>Promotions and Rewards</h2>
    <?php if ($promotions_result->num_rows > 0): ?>
        <ul>
            <?php while ($promo = $promotions_result->fetch_assoc()): ?>
                <li>
                    <strong><?= htmlspecialchars($promo['promo_code']) ?></strong>: 
                    <?= htmlspecialchars($promo['description']) ?> 
                    (<?= htmlspecialchars($promo['discount_percent']) ?>% off)
                </li>
            <?php endwhile; ?>
        </ul>
    <?php else: ?>
        <p>No active promotions.</p>
    <?php endif; ?>

    <!-- Account Settings -->
    <h2>Account Settings</h2>
    <a href="edit_profile.php">Edit Profile</a> | 
    <a href="change_password.php">Change Password</a>

    <p><a href="logout.php">Logout</a></p>


    <!-- Quick back to home while developing -->
    <br><br><br>
    <p><a href="index.php">Home</a></p>
</body>
</html>