<?php
session_start();
include 'database.php'; 
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get data from the AJAX request
    $service_id = $_POST['service_id'];
    $therapist_id = $_POST['therapist_id'];
    $appointment_date = $_POST['appointment_date'];
    $start_time = $_POST['start_time'];
    $end_time = $_POST['end_time'];
    $promo_code = $_POST['promo_code'];
    $payment_method = $_POST['payment_method'];
    $user_id = $_SESSION['user_id']; // Assuming user is logged in

    // Validate and process the booking (similar to your existing booking.php logic)
    // Example: Check therapist availability, apply promo code, etc.

    // Return a response
    echo json_encode(['status' => 'success', 'message' => 'Booking confirmed!']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request.']);
}
?> 